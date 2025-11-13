<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class,'register' ]);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class,'logout' ])->middleware('auth:sanctum');
Route::get('/allusers', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/updateusers/{user}', [UserController::class, 'update']);
Route::delete('/deleteusers/{id}', [UserController::class,'destroy']);
Route::get('/allcourses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth:sanctum');
Route::put('/updatecourses/{course}', [CourseController::class, 'update']);
Route::delete('/deletecourses/{id}', [CourseController::class,'destroy']);
Route::get('/course/{id}',[CourseController::class, 'show']);
Route::post('/courseenroll/{id}',[CourseController::class, 'enroll'])->middleware('auth:sanctum');
Route::post('/deletecourseenroll/{id}',[CourseController::class, 'unenroll'])->middleware('auth:sanctum');
