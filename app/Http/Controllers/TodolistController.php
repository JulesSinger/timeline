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

    public function update($todolist_id, Request $request) {
        $user = Auth::user();
        $user_id = $user->id;

        $todolist = Todolist::find($todolist_id);

        if ($request->name) {
            $todolist->name = $request->name;
        }

        if ($request->description) {
            $todolist->description = $request->description;
        }

        if ($request->color) {
            $todolist->color = $request->color;
        }

        $todolist->save();

        return response()->json(
            [
                'message' => 'Todolist modifiée avec succès.',
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

        $color = $request->color ? $request->color : '#000000';

        Auth::user();
        $user_id = Auth::id();

        $todolist = new Todolist();
        $todolist->name = $request->name;
        $todolist->user_id = $user_id;
        $todolist->description = $request->description;
        $todolist->color = $color;
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
