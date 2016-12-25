<?php
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	use DatabaseMigrations;
	
    /** @test */
    function can_get_is_admin()
    {
        $adminUser = factory(User::class)->create([
            'is_admin' => true
        ]);
        $user = factory(User::class)->create([
            'is_admin' => false
        ]);

        $isAdminAdminUser = $adminUser->isAdmin();
    	$isAdminUser = $user->isAdmin();

        $this->assertTrue($isAdminAdminUser);
    	$this->assertFalse($isAdminUser);
    }
}