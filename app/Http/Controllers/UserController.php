<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();

        $result = $this->userService->login($data["email"], $data["password"]);

        $user = new UserResource($result);
        return Json::success("success", "Login Successful", $user, 200);
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();

        $result = $this->userService->register($data);

        $user = new UserResource($result);
        return Json::success("success", "Register Successful", $user, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
