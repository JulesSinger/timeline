<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;

class TodolistController extends Controller
{
    public function show_todolist($id) {
        $todolist = Todolist::find($id);
        return new TodolistResource($todolist);
    }

    public function show_todolists() {
        $todolists = Todolist::all();
        return TodolistResource::collection($todolists);
    }

    public function delete($id, Request $request) {
        $todolist = Todolist::find($id);
        $todolist->delete();
        return response()->json(
            [
                'message' => 'Todolist supprimée avec succès.',
                'todolists' => TodolistResource::collection(Todolist::all())
            ], 200
        );
    }
}
