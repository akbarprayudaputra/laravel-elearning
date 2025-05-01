<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->userService->login($data["email"], $data["password"]);

        $user = new UserResource($result);
        return Json::success("success", "Login Successful", $user, 200);
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->userService->register($data);

        $user = new UserResource($result);
        return Json::success("success", "Register Successful", $user, 201);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->userService->logout($request);
        return Json::success("success", "Successfully logged out", [], 200);
    }

    public function getAllInstruturers(): JsonResponse
    {
        $instructors = $this->userService->getInstructors();
        return Json::success("success", "Success", UserResource::collection($instructors), 200);
    }

    public function getAllUsers(): JsonResponse
    {
        $users = $this->userService->getUsers();
        return Json::success("success", "Seccess get all users", UserResource::collection($users), 200);
    }

    public function getAllStudents(): JsonResponse
    {
        $students = $this->userService->getStudents();
        return Json::success("success", "Success", UserResource::collection($students), 200);
    }

    public function getAllAdmins(): JsonResponse
    {
        $admins = $this->userService->getAdmins();
        return Json::success("success", "Success", UserResource::collection($admins), 200);
    }
}
