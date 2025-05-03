<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Resources\EnrollmentResource;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function __construct(private EnrollmentService $enrollmentService) {}
    public function createEnrollment(EnrollmentRequest $request)
    {
        $data = $request->validated();
        $enrollment = $this->enrollmentService->create($data);

        return Json::success("success", "Success Add New Enrollment", new EnrollmentResource($enrollment), 201);
    }

    public function deleteEnrollment(int $id)
    {
        try {
            $this->enrollmentService->delete($id);
            return Json::success("success", "Success Delete Enrollment", 0);
        } catch (\Throwable $th) {
            //throw $th;
            return Json::error("error", $th->getMessage(), 404);
        }
    }

    public function getAllEnrollments()
    {
        $enrollments = $this->enrollmentService->getAll();
        return Json::success("success", "Success Get All Enrollment", EnrollmentResource::collection($enrollments), 200);
    }

    public function getEnrollmentById(int $id)
    {
        try {
            $enrollment = $this->enrollmentService->getById($id);
            return Json::success("success", "Success Get Enrollment By Id", new EnrollmentResource($enrollment), 200);
        } catch (\Throwable $th) {
            return Json::error("error", "Enrollment Not Found", 404);
        }
    }
}
