<?php

use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('service.key')->group(function () {
    Route::get('payments', [PaymentController::class, 'index']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::get('reports', [PaymentController::class, 'report']);
});
