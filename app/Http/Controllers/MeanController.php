<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseUnitResource;
use App\Http\Resources\MarkResource;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Mark;
use App\Models\CourseUnit;

class MeanController extends Controller
{
    public function list_course_units() {
        return CourseUnitResource::collection(CourseUnit::all());
    }

    public function list_subjects() {
        return SubjectResource::collection(Subject::all());
    }

    public function list_marks() {
        return MarkResource::collection(Mark::all());
    }
}
