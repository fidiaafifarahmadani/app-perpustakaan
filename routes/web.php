<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Dashboard
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

// Protected
Route::middleware(['auth'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except(['show']);
    });

    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);

    Route::get('/loans/report', [LoanController::class, 'report'])
        ->name('loans.report');

    Route::put('/loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])
        ->name('loans.kembalikan');

    Route::resource('loans', LoanController::class);
});