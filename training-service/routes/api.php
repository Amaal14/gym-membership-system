<?php

use App\Http\Controllers\Api\WorkoutPlanController;
use Illuminate\Support\Facades\Route;

Route::middleware('service.key')->group(function () {
    Route::get('workout-plans', [WorkoutPlanController::class, 'index']);
    Route::get('workout-plans/{workoutPlan}', [WorkoutPlanController::class, 'show']);
    Route::post('workout-plans', [WorkoutPlanController::class, 'store']);
});
