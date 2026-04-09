<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::get('projects/{project}/matches', [ProjectController::class, 'matches'])->name('projects.matches');
});

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('profiles', AdminProfileController::class);
    Route::resource('users', AdminUserController::class);
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('admin.projects.show');
});

Route::post('/projects/{project}/apply', [ApplicationController::class, 'store'])
    ->name('projects.apply')
    ->middleware('auth');

Route::delete('/projects/{project}/unapply', [ApplicationController::class, 'destroy'])
    ->name('projects.unapply')
    ->middleware('auth');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/applications', [ApplicationController::class, 'index'])
        ->name('admin.applications.index');
});

require __DIR__.'/auth.php';
