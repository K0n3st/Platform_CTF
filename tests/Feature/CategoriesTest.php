<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Challenge;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function adminIndex()
    {
        $admin = factory(\App\User::class)
        ->create(['type' => 1]);
        $response = $this->actingAs($admin)->get('admin/category');
        $response->assertStatus(200);
    }

    public function UserIndex()
    {
        $admin = factory(\App\User::class)
        ->create(['type' => 0]);
        $response = $this->actingAs($admin)->get('admin/category');
        $response->assertStatus(302);
    }

    public function testCreate()
    {
        $admin = factory(\App\User::class)
            ->create(['type' => 1]);
        $response = $this->actingAs($admin)->get('admin/category/create');
        $response->assertStatus(200);
    }

}