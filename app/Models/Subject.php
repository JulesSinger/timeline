<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function course_unit() {
        return $this->belongsTo(CourseUnit::class);
    }

    public function marks() {
        return $this->hasMany(Mark::class);
    }
}
