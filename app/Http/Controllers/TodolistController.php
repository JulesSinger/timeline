<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodolistController extends Controller
{
    public function show_todolist($id) {
        $todolist = Todolist::find($id);
        return new TodolistResource($todolist);
    }

    public function show_todolists() {
        Auth::user();
        $user_id = Auth::id();
        $todolists = Todolist::where('user_id', $user_id)->get();
        return TodolistResource::collection($todolists);
    }

    public function delete($id, Request $request) {
        $todolist = Todolist::find($id);
        $todolist->delete();
        Auth::user();
        $user_id = Auth::id();

        return response()->json(
            [
                'message' => 'Todolist supprimée avec succès.',
                'todolists' => TodolistResource::collection(Todolist::where('user_id', $user_id)->get())
            ], 200
        );
    }

    public function create(Request $request) {
        $requestData = $request->all();

        $validator = Validator::make($requestData,[
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Auth::user();
        $user_id = Auth::id();

        $todolist = new Todolist();
        $todolist->name = $request->name;
        $todolist->user_id = $user_id;
        $todolist->description = $request->description;
        $todolist->save();

        return response()->json(
            [
                'message' => 'Todolist créée avec succès.',
                // todolist where user_id = $user_id
                'todolists' => TodolistResource::collection(Todolist::where('user_id', $user_id)->get())
            ], 200
        );
    }
}
