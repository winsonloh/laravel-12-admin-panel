<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Middleware\AdminAuthenticate;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware(AdminAuthenticate::class)->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Role
    Route::resource('/roles', RoleController::class)
        ->except(['show']);

    // Permission
    Route::resource('/permissions', PermissionController::class)
        ->except(['show']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // User
    Route::resource('/users', UserController::class);

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    
});
