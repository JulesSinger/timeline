<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Todolist;
use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodolistResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function create($todolist_id, Request $request) {
        $requestData = $request->all();

        $validator = Validator::make($requestData,[
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $user_id = $user->id;
        $todo = new Todo();
        $todo->user_id = $user_id;
        $todo->todolist_id = $todolist_id;
        $todo->title = $request->title;
        $todo->priority = $request->priority;
        $todo->description = $request->description;
        $todo->deadline = $request->deadline;
        $todo->done = false;
        $todo->save();

        return response()->json(
            [
                'message' => 'Tâche ajoutée avec succès.',
                'todolist' => new TodolistResource(Todolist::find($todolist_id))
            ], 200
        );
    }

    public function update($todolist_id, $todo_id, Request $request) {
        $todo = Todo::find($todo_id);

        if ($request->title) {
            $todo->title = $request->title;
        }

        if ($request->priority) {
            $todo->priority = $request->priority;
        }

        if ($request->description) {
            $todo->description = $request->description;
        }

        if ($request->deadline) {
            $todo->deadline = $request->deadline;
        }

        $todo->save();

        return response()->json(
            [
                'message' => 'Tâche ajoutée avec succès.',
                'todolist' => new TodolistResource(Todolist::find($todolist_id))
                
            ], 200
        );
    }

    public function switch($todolist_id, $todo_id) {
        $todo = Todo::find($todo_id);
        $todo->done = !$todo->done;
        $todo->save();
        return response()->json(
            [
                'message' => 'Tâche modifiée avec succès.',
                'todolist' => new TodolistResource(Todolist::find($todolist_id))
            ], 200
        );
    }
}
