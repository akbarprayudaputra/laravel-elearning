<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "student_id" => $this->student_id,
            "course_id" => $this->course_id,
            "student" => new UserResource($this->whenLoaded("student")),
            "course" => new CourseResource($this->whenLoaded("course")),
        ];
    }
}
