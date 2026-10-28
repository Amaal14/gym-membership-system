<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WorkoutPlanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ---------- admin only ----------
    Route::middleware('role:admin')->group(function () {
        Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
        Route::post('/members', [MemberController::class, 'store'])->name('members.store');

        Route::get('/memberships/create', [MembershipController::class, 'create'])->name('memberships.create');
        Route::post('/memberships', [MembershipController::class, 'store'])->name('memberships.store');

        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
        Route::put('/attendance/{id}/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');

        Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    });

    // ---------- admin + trainer ----------
    Route::middleware('role:admin,trainer')->group(function () {
        Route::get('/members', [MemberController::class, 'index'])->name('members.index');
        Route::get('/workout-plans/create', [WorkoutPlanController::class, 'create'])->name('workout-plans.create');
        Route::post('/workout-plans', [WorkoutPlanController::class, 'store'])->name('workout-plans.store');
    });

    // ---------- admin + member ----------
    Route::middleware('role:admin,member')->group(function () {
        Route::get('/memberships', [MembershipController::class, 'index'])->name('memberships.index');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    });

    // ---------- all roles (the controller filters the data by role) ----------
    Route::get('/workout-plans', [WorkoutPlanController::class, 'index'])->name('workout-plans.index');
    Route::get('/workout-plans/{id}', [WorkoutPlanController::class, 'show'])->name('workout-plans.show');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
});
