<?php

use App\Http\Controllers\SecretController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [SecretController::class, 'index'])->name('home');
Route::post('/secrets', [SecretController::class, 'store']);
Route::get('/s/{token}', [SecretController::class, 'show']);
Route::post('/s/{token}/reveal', [SecretController::class, 'reveal']);
Route::get('/expired', fn() => inertia('Expired'));
Route::get('/audit/{auditToken}', [AuditController::class, 'show']);

// Auth routes (Breeze generates these)
require __DIR__ . '/auth.php';

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/dashboard/secrets/{token}', [DashboardController::class, 'destroy'])->name('secrets.destroy');
});