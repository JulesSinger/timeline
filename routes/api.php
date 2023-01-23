<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimelineController;

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

Route::get('/timeline/items', [TimelineController::class, 'list']);
Route::post('/timeline/insert', [TimelineController::class, 'store']);
Route::patch('/timeline/update/{id}', [TimelineController::class, 'update']);
Route::delete('/timeline/delete/{id}', [TimelineController::class, 'delete']);
