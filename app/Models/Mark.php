<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function course_unit() {
        return $this->belongsToThrough(CourseUnit::class, Subject::class);
    }
}
