<?php

use App\Http\Controllers\VerificationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::Get('/example', function () {
        return Inertia::render('Example');
    })->name('example');

    Route::post('/verify/phone', [VerificationController::class, 'phone']);
    Route::post('/verify/code', [VerificationController::class, 'code']);
    Route::post('/verify/profile', [VerificationController::class, 'profile']);
});
