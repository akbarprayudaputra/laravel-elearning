<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'instructor_id', 'category', 'price'];

    // Relasi: Setiap kursus dimiliki oleh satu instruktur
    public function instructor()
    {
        return $this->belongsTo(Course::class, 'instructor_id', 'id');
    }
}
