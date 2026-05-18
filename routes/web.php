<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoBuilderController;
use App\Http\Controllers\CompatibilityController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RigController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────

Route::get('/', fn () => view('index'))->name('landing');

Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login'])->name('login.process');

Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// ─────────────────────────────────────────
// AUTHENTICATED ROUTES
// ─────────────────────────────────────────

Route::middleware('auth')->group(function () {

    // Dashboard & Garasi
    Route::get('/dashboard', [RigController::class, 'index'])->name('dashboard');

    // Profil Pengguna
    Route::get('/profile',          [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile',         [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password',[ProfileController::class, 'updatePassword'])->name('profile.password');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Katalog & Builder
    Route::get('/builder',       [ComponentController::class, 'builder'])->name('builder.index');
    Route::get('/components',    [ComponentController::class, 'index'])->name('components.index');
    Route::get('/components/{id}', [ComponentController::class, 'show'])->name('components.show');

    // Rakitan (Rig)
    Route::get('/rigs',                  [RigController::class, 'index'])->name('rigs.index');
    Route::post('/rigs',                 [RigController::class, 'store'])->name('rigs.store');
    Route::get('/rigs/{id}',             [RigController::class, 'show'])->name('rigs.show');
    Route::post('/rigs/add-component',   [RigController::class, 'addComponent'])->name('rigs.add_component');
    Route::post('/rigs/remove-component',[RigController::class, 'removeComponent'])->name('rigs.remove_component');

    // Kompatibilitas
    Route::get('/rigs/{id}/compatibility', [CompatibilityController::class, 'index'])->name('compatibility.index');

    // Auto Builder
    Route::get('/autobuilder', [AutoBuilderController::class, 'index'])->name('autobuilder.index');

    // Admin
    Route::get('/admin/dashboard',          [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/hardware/store',    [AdminController::class, 'storeHardware'])->name('admin.hardware.store');
    Route::post('/admin/components',        [ComponentController::class, 'store'])->name('components.store');
});