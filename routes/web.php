<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn() => redirect()->route('dashboard'));


Auth::routes(['register' => false]); // Disable registration for admin control

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Grouping routes with middleware to ensure only authenticated users can access
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        // User Management
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('/user/changePassword', [HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
        Route::post('/user/changePassword', [HomeController::class, 'changePasswordPost'])->name('changePasswordPost');

        // Role Management
        Route::resource('roles', RoleController::class)->except(['show']);

        // Permission Management
        Route::resource('permissions', PermissionController::class)->except(['show']);

        // Project Management Routes
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create'); // Show create form
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store'); // Store new project
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit'); // Show edit form
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update'); // Update project
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // Delete project
    });

    // Project Management Routes
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index'); // View all projects
    });

    // Task Management Routes
    Route::middleware(['role:admin,manager,user'])->group(function () {
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); // View tasks
        Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Show edit form
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Update task
    });
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Show create form
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Store new task
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Delete task
    });
});
