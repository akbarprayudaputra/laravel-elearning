<?php

namespace App\Services;

use App\Models\User;

interface UserService
{
    public function register(string $username, string $password): bool;
    public function login(string $email, string $password): User;
    public function logout(): bool;
    public function getInstructors(): array;
    public function getAdmins(): array;
    public function getStudents(): array;
}
