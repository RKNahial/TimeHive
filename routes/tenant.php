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
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Requirement\RequirementController;
use App\Http\Controllers\Report\ReportController;
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
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])
            ->name('tenant.admin.dashboard');
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])
                ->name('tenant.admin.dashboard');
            Route::get('/staff/register', [StaffRegistrationController::class, 'showRegistrationForm'])
                ->name('staff.register');
            Route::post('/staff/register', [StaffRegistrationController::class, 'register'])
                ->name('staff.register.save');
            Route::post('/instructor', [StaffRegistrationController::class, 'register'])
                ->name('tenant.instructor.store');
            Route::get('/students', [StudentController::class, 'index'])
                ->name('tenant.students.index');
            Route::get('/staff', [StaffController::class, 'index'])
                ->name('tenant.staff.index');
            Route::get('/courses', [CourseController::class, 'index'])
                ->name('tenant.courses.index');
            Route::get('/requirements', [RequirementController::class, 'index'])
                ->name('tenant.requirements.index');
            Route::prefix('reports')->group(function () {
                Route::get('/students', [ReportController::class, 'students'])
                    ->name('tenant.reports.students');
                Route::get('/staff', [ReportController::class, 'staff'])
                    ->name('tenant.reports.staff');
                Route::get('/courses', [ReportController::class, 'courses'])
                    ->name('tenant.reports.courses');
                Route::get('/requirements', [ReportController::class, 'requirements'])
                    ->name('tenant.reports.requirements');
            });
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