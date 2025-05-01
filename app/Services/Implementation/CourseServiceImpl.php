<?php

namespace App\Services\Implementation;

use App\Models\Course;
use App\Services\CourseService;

class CourseServiceImpl implements CourseService
{
    public function create(array $data): Course
    {
        return new Course($data);
    }
}
