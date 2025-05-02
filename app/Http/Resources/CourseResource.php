<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "title" => $this->title,
            "description" => $this->description,
            "instructor_id" => $this->instructor_id,
            "category" => $this->category,
            "price" => $this->price,
            "instructor" => new UserResource($this->whenLoaded("instructor")),
        ];
    }
}
