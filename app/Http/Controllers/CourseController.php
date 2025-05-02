<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService) {}

    public function createCourse(CourseRequest $request)
    {
        try {
            Gate::authorize("create", Course::class);

            $data = $request->validated();
            $course = $this->courseService->create($data);
            return Json::success("success", "Success Add New Course", new CourseResource($course), 201);
        } catch (AuthorizationException  $e) {
            return Json::error("error", $e->getMessage(), 404);
        }
    }

    public function getAllCourse()
    {
        $course = $this->courseService->getAll();
        return Json::success("success", "Success Get All Course", CourseResource::collection($course), 200);
    }

    public function getCourseById(int $id)
    {
        try {
            $course = $this->courseService->getById($id);
            return Json::success("success", "Success Get Course By Id", new CourseResource($course), 200);
        } catch (\Throwable $th) {
            return Json::error("error", "Course Not Found", 404);
        }
    }

    public function updateCourse(CourseRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $course = $this->courseService->update($id, $data);

            return Json::success("success", "Success Update Course", new CourseResource($course), 200);
        } catch (\Throwable  $e) {
            return Json::error("error", $e->getMessage(), 404);
        }
    }

    public function deleteCourse(int $id)
    {
        try {
            $this->courseService->delete($id);
            return Json::success("success", "Success Delete Course", [], 200);
        } catch (\Throwable  $e) {
            return Json::error("error", $e->getMessage(), 404);
        }
    }
}
