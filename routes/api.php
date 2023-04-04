<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\MeanController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Todolist;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy']);
Route::get('/user', [AuthController::class, 'getCurrentUser']);
Route::post('/register', [AuthController::class, 'create']);

Route::get('/timeline/items', [TimelineController::class, 'list']);
Route::post('/timeline/insert', [TimelineController::class, 'store']);
Route::patch('/timeline/update/{id}', [TimelineController::class, 'update']);
Route::delete('/timeline/delete/{id}', [TimelineController::class, 'delete']);
Route::get('/mean/{id}', [MeanController::class, 'list_course_units']);

Route::get('/todolist/{id}', [TodolistController::class, 'show_todolist']);
Route::get('/todolists', [TodolistController::class, 'show_todolists']);
Route::delete('/todolist/{todolist_id}', [TodolistController::class, 'delete']);
Route::post('/todolist/insert', [TodolistController::class, 'create']);
Route::get('/todolist/{id}/todos', [TodoController::class, 'list_todos']);
Route::delete('/todolist/{todolist_id}/todos/{todo_id}', [TodoController::class, 'delete']);
Route::post('/todolists/{todolist_id}/todos/insert', [TodoController::class, 'create']);
Route::post('/todolists/{todolist_id}/todos/{todo_id}/switch', [TodoController::class, 'switch']);