<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === "instructor" ? Response::allow() : Response::deny('You are not allowed to create a course.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $course): Response
    {
        return ($user->role === "instructor") && ($user->id === $course->instructor_id)  ? Response::allow() : Response::deny('You are not allowed to update a course.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $course): Response
    {
        return ($user->role === "instructor") && ($user->id === $course->instructor_id)  ? Response::allow() : Response::deny('You are not allowed to update a course.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return false;
    }
}
