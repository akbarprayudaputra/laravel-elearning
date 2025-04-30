<?php

namespace App\Services\Implementation;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    public function register(string $username, string $password): bool
    {
        return true;
    }

    public function login(string $email, string $password): User
    {
        $user = User::where("email", $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "Email or Password is incorrect",
                ]
            ], 401));
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $user->token = $token;

        return $user;
    }

    public function logout(): bool
    {
        return true;
    }

    public function getInstructors(): array
    {
        return [];
    }

    public function getAdmins(): array
    {
        return [];
    }

    public function getStudents(): array
    {
        return [];
    }
}
