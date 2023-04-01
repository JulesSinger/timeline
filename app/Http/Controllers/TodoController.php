<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodolistResource;

class TodoController extends Controller
{
    public function list_todos($id, Request $request) {
        return TodoResource::collection(Todo::where('todolist_id', $id)->get());
    }

    public function delete($todolist_id, $todo_id, Request $request) {
        $todo = Todo::find($todo_id);
        $todo->delete();
        return response()->json(
            [
                'message' => 'Tâche supprimée avec succès.',
                'todolist' => new TodolistResource(Todolist::find($todolist_id))
            ], 200
        );
    }
}
