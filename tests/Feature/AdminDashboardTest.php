<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase; // zorgt dat database wordt gereset per test

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'Admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Top 3 Matches'); // check dat de view content bevat
    }

    public function test_non_admin_cannot_access_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'User',
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }
}