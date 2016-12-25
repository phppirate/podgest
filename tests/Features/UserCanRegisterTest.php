<?php
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanRegisterTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    function a_user_can_register()
    {
        // arrange
        $user = [
        	'name' => 'John Doe',
        	'email' => 'john@example.com',
        	'password' => 'password'
        ];
        // act
        $this->json('post', '/api/v1/user', $user);
        // assert
		$this->assertResponseStatus(201);
		$this->assertEquals('John Doe', User::first()->name);
		$this->assertEquals('john@example.com', User::first()->email);
		$this->assertNotNull(User::first()->password);
		$this->assertNotNull(User::first()->api_token);
    }
}