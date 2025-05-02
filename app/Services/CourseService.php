<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Collection;

interface CourseService
{
    public function create(array $data): Course;
    public function getAll(): Collection;
    public function getById(int $id): Course;
    public function update(int $id, array $data): Course;
    public function delete(int $id): bool;
}
