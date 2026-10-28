<?php

use App\Http\Controllers\Api\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::middleware('service.key')->group(function () {
    Route::get('attendance', [AttendanceController::class, 'index']);
    Route::post('attendance', [AttendanceController::class, 'store']);
    Route::put('attendance/{record}/check-out', [AttendanceController::class, 'checkOut']);
});
