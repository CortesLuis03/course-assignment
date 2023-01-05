<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

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

Route::get('/students',[App\Http\Controllers\StudentController::class, 'index']);
Route::get('/student/{id}',[App\Http\Controllers\StudentController::class, 'show']);
Route::post('/student/save',[App\Http\Controllers\StudentController::class, 'store']);
Route::put('/student/update/{id}',[App\Http\Controllers\StudentController::class, 'update']);
Route::delete('/student/delete/{id}',[App\Http\Controllers\StudentController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
