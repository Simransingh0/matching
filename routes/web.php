<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

// -------------------------------------
// Public Routes
// -------------------------------------
Route::get('/', fn() => view('welcome'))->name('home');

// -------------------------------------
// Authenticated User Routes
// -------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [ApplicationController::class, 'dashboard'])->name('dashboard');
    Route::post('/applications/{application}/cancel', [App\Http\Controllers\ApplicationController::class, 'cancel'])->name('applications.cancel');

    // Profile management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //Profielen voor skills
    Route::resource('profiles', AdminProfileController::class);

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::get('projects/{project}/matches', [ProjectController::class, 'matches'])->name('projects.matches');

    // Applications
    Route::prefix('projects/{project}')->group(function () {
        Route::post('/apply', [ApplicationController::class, 'store'])->name('projects.apply');
        Route::delete('/unapply', [ApplicationController::class, 'destroy'])->name('projects.unapply');
    });
});

// -------------------------------------
// Admin Routes
// -------------------------------------
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users & Profiles
    Route::resource('users', AdminUserController::class);
    

    // Projects (admin view)
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('admin.projects.show');

    // Applications management
    Route::prefix('applications')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('admin.applications.index');
        Route::post('/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
        Route::post('/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
    });
});

require __DIR__.'/auth.php';