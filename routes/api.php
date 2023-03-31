<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\MeanController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\TodoController;
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

Route::get('/timeline/{timelineId}/items', [TimelineController::class, 'list']);
Route::post('/timeline/{timelineId}/insert', [TimelineController::class, 'store']);
Route::patch('/timeline/update/{id}', [TimelineController::class, 'update']);
Route::delete('/timeline/delete/{id}', [TimelineController::class, 'delete']);
Route::get('/mean/{id}', [MeanController::class, 'list_course_units']);

Route::get('/todolist/{id}', [TodolistController::class, 'show_todolist']);
Route::get('/todolist/{id}/todos', [TodoController::class, 'list_todos']);