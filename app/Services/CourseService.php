<?php

namespace App\Services;

use App\Models\Course;

interface CourseService
{
    public function create(array $data): Course;
}
