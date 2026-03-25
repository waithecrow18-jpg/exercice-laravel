<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PublicCategoryController;
use App\Http\Controllers\Api\PublicTrainingController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'store']);

Route::get('/trainings', [PublicTrainingController::class, 'index']);
Route::get('/trainings/{slug}', [PublicTrainingController::class, 'show']);
Route::get('/categories', [PublicCategoryController::class, 'index']);

Route::middleware(['auth:sanctum', 'active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/enrollments', [EnrollmentController::class, 'index']);
    Route::post('/enrollments', [EnrollmentController::class, 'store']);
});
