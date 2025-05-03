<?php

namespace App\Services;

use App\Models\Enrollment;
use Illuminate\Support\Collection;

interface EnrollmentService
{
    public function create(array $data): Enrollment;
    public function delete(int $id): bool;
    public function getAll(): Collection;
    public function getById(int $id): Enrollment;
}
