<?php

use App\Helpers\Json;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get("/user", function () {
    return Json::success("success", "Login Successful", [
        "user" => UserResource::collection(User::all()),
    ], 200);
});

Route::post("/login", [App\Http\Controllers\UserController::class, 'login']);
Route::post("/register", [App\Http\Controllers\UserController::class, 'register']);
Route::delete("/logout", [App\Http\Controllers\UserController::class, 'logout'])->middleware(["auth:sanctum"]);
