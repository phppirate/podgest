<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CanGetApiTokenTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function api_token_can_be_fetched_with_a_email_and_password()
    {
        $this->disableExceptionHandling();
        // arrange
        $user = factory(User::class)->create([
            'email'    => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
        // act
        $this->json('post', '/api/v1/user/api_token', [
            'email'    => 'john@example.com',
            'password' => 'password',
        ]);

        // assert
        $this->assertResponseStatus(200);
        $this->seeJsonContains([
            'api_token' => $user->api_token,
        ]);
    }

    /** @test */
    public function invalid_credentials_fails_authentication()
    {
        // arrange
        $user = factory(User::class)->create([
            'email'    => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
        // act
        $this->json('post', '/api/v1/user/api_token', [
            'email'    => 'john@example.com',
            'password' => 'passwords',
        ]);

        // assert
        $this->assertResponseStatus(422);
        $this->seeJson([
            'message' => 'These Credentials do not match any records in our database',
        ]);
    }
}
