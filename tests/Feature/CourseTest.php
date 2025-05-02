<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function test_create()
    {
        $user = new User([
            "name" => "John Doe",
            "email" => "YhN9h@example.com",
            "password" => "password",
            "role" => "student",
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $response = $this->actingAs($user, $token)->post('/api/course', [
            "title" => "Kursus Baru",
            "description" => "Deskripsi Kursus Baru",
            "instructor_id" => 1,
            "category" => "Math",
            "price" => 100000,
        ]);

        $response->assertStatus(200);
    }
}
