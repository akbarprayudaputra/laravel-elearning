<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    public function test_user_can_register()
    {
        $this->post("/api/register", [
            "name" => "John Doe",
            "email" => "YhN9h@example.com",
            "password" => "password"
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    "name" => "John Doe",
                    "email" => "YhN9h@example.com"
                ]
            ]);
    }
    public function test_login_success()
    {
        // Buat user dummy untuk testing
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Kirim request login
        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        // Pastikan respons sukses
        $response->assertStatus(200);
        $response->assertJsonStructure(["data", "status"]);
    }

    public function test_login_fails_with_wrong_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'errors' => ['Email or Password is incorrect'],
        ]);
    }

    public function test_user_can_logout()
    {
        // Buat user dummy
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Buat token Sanctum untuk user
        Sanctum::actingAs($user, ['*']);

        // Kirim request logout dengan Authorization Bearer Token
        $response = $this->deleteJson('/api/logout');

        // Pastikan respons sukses dan token terhapus
        $response->assertStatus(200)
            ->assertJson(["message" => "Successfully logged out"]);
    }
}
