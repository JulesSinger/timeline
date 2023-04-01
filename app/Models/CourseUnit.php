<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUnit extends Model
{
    use HasFactory;

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function marks() {
        return $this->hasManyThrough(Mark::class, Subject::class);
    }
}
