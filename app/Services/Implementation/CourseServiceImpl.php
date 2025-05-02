<?php

namespace App\Services\Implementation;

use App\Models\Course;
use App\Services\CourseService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class CourseServiceImpl implements CourseService
{
    public function create($data): Course
    {
        $course = new Course();
        $course->title = $data["title"];
        $course->description = $data["description"];
        $course->instructor_id = $data["instructor_id"];
        $course->category = $data["category"];
        $course->price = $data["price"];
        $course->save();

        return $course;
    }

    public function getAll(): Collection
    {
        $courses = Course::with("instructor")->get();
        return $courses;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $course = Course::where("id", $id)->first();
        if ($course == null) {
            throw new Exception("Course Not Found");
        }

        Gate::authorize("delete", [Course::class, $course]);

        $course->delete();
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): Course
    {
        $course = Course::with("instructor")->findOrFail($id);
        return $course;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Course
    {
        $course = Course::where("id", $id)->first();
        if ($course == null) {
            throw new Exception("Course Not Found");
        }

        Gate::authorize("update", [Course::class, $course]);

        $course->title = $data["title"];
        $course->description = $data["description"];
        $course->instructor_id = $data["instructor_id"];
        $course->category = $data["category"];
        $course->price = $data["price"];
        $course->save();

        return $course;
    }
}
