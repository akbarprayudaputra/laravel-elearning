<?php

namespace App\Services\Implementation;

use App\Models\Enrollment;
use App\Services\EnrollmentService;
use Illuminate\Support\Collection;

class EnrollmentServiceImpl implements EnrollmentService
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Enrollment
    {
        $enrollment = new Enrollment();
        $enrollment->student_id = $data["student_id"];
        $enrollment->course_id = $data["course_id"];

        $enrollment->save();

        return $enrollment;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $enrollment = Enrollment::where("id", $id)->first();
        if ($enrollment == null) {
            throw new \Exception("Enrollment Not Found");
        }

        $enrollment->delete();
        return true;
    }

    public function getAll(): Collection
    {
        $enrollments = Enrollment::with("student", "course")->get();
        return $enrollments;
    }

    public function getById(int $id): Enrollment
    {
        $enrollment = Enrollment::with("student", "course")->where("id", $id)->first();
        if ($enrollment == null) {
            throw new \Exception("Enrollment Not Found");
        }
        return $enrollment;
    }
}
