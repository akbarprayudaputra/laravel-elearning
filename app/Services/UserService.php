<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserService
{
    public function register(array $data): User;
    public function login(string $email, string $password): User;
    public function logout($request): bool;
    public function getInstructors(): Collection;
    public function getAdmins(): Collection;
    public function getStudents(): Collection;
    public function getUsers(): Collection;
}
