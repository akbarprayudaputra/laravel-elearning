<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("/login", [UserController::class, "login"]);
Route::post("/register", [UserController::class, "register"]);
Route::delete("/logout", [UserController::class, "logout"])->middleware("auth:sanctum");

Route::prefix("user")->middleware("auth:sanctum")->group(function () {
    Route::get("/", [UserController::class, "getAllUsers"]);
    Route::get("/instructurers", [UserController::class, "getAllInstruturers"]);
    Route::get("/admins", [UserController::class, "getAllAdmins"]);
    Route::get("/students", [UserController::class, "getAllStudents"]);
});
