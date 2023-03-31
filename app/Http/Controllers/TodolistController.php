<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;

class TodolistController extends Controller
{
    public function show_todolist($id, Request $request) {
        $todolist = Todolist::find($id);
        return new TodolistResource($todolist);
    }
}
