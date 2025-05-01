<?php

namespace App\Services\Implementation;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    public function register(array $data): User
    {
        if (User::where("email", $data["email"])->first() !== null) {
            throw new HttpResponseException(response([
                "errors" => [
                    "email" => "Email already exists",
                ]
            ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data["password"]);
        $user->save();

        return $user;
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

    public function logout($request): bool
    {
        $request->user()->tokens()->delete();

        return true;
    }

    public function getInstructors(): Collection
    {
        return User::where("role", "instructor")->get();

        // return $instructurers;
    }

    public function getAdmins(): Collection
    {
        return User::where("role", "admin")->get();
    }

    public function getStudents(): Collection
    {
        return User::where("role", "student")->get();
    }

    public function getUsers(): Collection
    {
        return User::all();
    }
}
