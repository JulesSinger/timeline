<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function list_todos($id, Request $request) {
        return TodoResource::collection(Todo::where('todolist_id', $id)->get());
    }
}
