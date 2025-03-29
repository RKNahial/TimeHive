<?php

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider
| with the tenancy and web middleware groups. Good luck!
|
*/

use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Staff\StaffAuthController;
use App\Http\Controllers\Staff\StaffRegistrationController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
    ->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])
            ->name('tenant.login');
        Route::post('/login', [LoginController::class, 'login'])
            ->name('tenant.login.post');
    });

Route::middleware(['web', 'tenant', 'auth:admin'])
    ->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])
                ->name('tenant.admin.dashboard');
            Route::get('/staff/register', [StaffRegistrationController::class, 'showRegistrationForm'])
                ->name('staff.register');
            Route::post('/staff/register', [StaffRegistrationController::class, 'register'])
                ->name('staff.register.save');
        });
    });

// Staff routes
Route::prefix('staff')->group(function () {
    // Staff auth routes (no auth required)
    Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
    Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login.post');
    Route::post('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');

    // Protected staff routes
    Route::middleware(['auth:staff'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staffDashboard'])
            ->name('staff.dashboard');
    });
});