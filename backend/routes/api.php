<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;

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

Route::prefix('student')->group(function() {
    Route::get('/list',[App\Http\Controllers\StudentController::class, 'index']);
    Route::get('/{id}',[App\Http\Controllers\StudentController::class, 'show']);
    Route::post('/save',[App\Http\Controllers\StudentController::class, 'store']);
    Route::put('/update/{id}',[App\Http\Controllers\StudentController::class, 'update']);
    Route::delete('/delete/{id}',[App\Http\Controllers\StudentController::class, 'destroy']);
});

Route::prefix('teacher')->group(function() {
    Route::get('/list',[App\Http\Controllers\TeacherController::class, 'index']);
    Route::get('/{id}',[App\Http\Controllers\TeacherController::class, 'show']);
    Route::post('/save',[App\Http\Controllers\TeacherController::class, 'store']);
    Route::put('/update/{id}',[App\Http\Controllers\TeacherController::class, 'update']);
    Route::delete('/delete/{id}',[App\Http\Controllers\TeacherController::class, 'destroy']);
});

Route::prefix('course')->group(function() {
    Route::get('/list',[App\Http\Controllers\CourseController::class, 'index']);
    Route::get('/{id}',[App\Http\Controllers\CourseController::class, 'show']);
    Route::post('/save',[App\Http\Controllers\CourseController::class, 'store']);
    Route::put('/update/{id}',[App\Http\Controllers\CourseController::class, 'update']);
    Route::delete('/delete/{id}',[App\Http\Controllers\CourseController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
