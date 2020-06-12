<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testDefaultUserIsNotAdmin()
    {
        $user = factory(\App\User::class)->create();
        $this->assertFalse($user->isAdmin());
    }

    public function testAdminUserIsAnAdmin()
    {
        $admin = factory(\App\User::class)
            ->create(['type' => 1]);
        $this->assertTrue($admin->isAdmin());
    }

    public function testAdminViewUsers()
    {
        $admin = factory(\App\User::class)
            ->create(['type' => 1]);

        $response = $this->actingAs($admin)->get('/users');
        $response->assertStatus(200);
    }

    public function testAdminViewAdminPage()
    {
        $admin = factory(\App\User::class)
            ->create(['type' => 1]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }


    public function testUserViewUsers()
    {
        $admin = factory(\App\User::class)
            ->create();

        $response = $this->actingAs($admin)->get('/users');
        $response->assertStatus(200);
    }

    public function testUserViewAdminPage()
    {
        $admin = factory(\App\User::class)
            ->create();

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(302);
    }

}