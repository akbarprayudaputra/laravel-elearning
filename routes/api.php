<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/login", [App\Http\Controllers\UserController::class, 'login']);
Route::post("/register", [App\Http\Controllers\UserController::class, 'register']);
Route::delete("/logout", [App\Http\Controllers\UserController::class, 'logout'])->middleware(["auth:sanctum"]);
