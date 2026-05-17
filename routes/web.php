<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\RigController;
use App\Http\Controllers\CompatibilityController;
use App\Http\Controllers\AutoBuilderController;

// ==========================================
// ROUTE AUTENTIKASI (LOGIN & LOGOUT)
// ==========================================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// ROUTE HALAMAN UTAMA / DASHBOARD (WAJIB LOGIN)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Halaman Utama setelah Login (bisa diarahkan ke list rakitan)
    Route::get('/dashboard', [RigController::class, 'index'])->name('dashboard');

    // 1. Fitur Manajemen Komponen PC
    Route::get('/components', [ComponentController::class, 'index'])->name('components.index');
    Route::get('/components/{id}', [ComponentController::class, 'show'])->name('components.show');
    Route::post('/admin/components', [ComponentController::class, 'store'])->name('components.store'); // Untuk input komponen baru oleh Admin

    // 2. Fitur Rakit Komputer (Rig)
    Route::get('/rigs', [RigController::class, 'index'])->name('rigs.index');
    Route::post('/rigs', [RigController::class, 'store'])->name('rigs.store');
    Route::get('/rigs/{id}', [RigController::class, 'show'])->name('rigs.show');
    Route::post('/rigs/{id}/add-component', [RigController::class, 'addComponent'])->name('rigs.add_component');

    // 3. Fitur Cek Kompatibilitas Komponen
    Route::get('/rigs/{id}/compatibility', [CompatibilityController::class, 'index'])->name('compatibility.index');

    // 4. Fitur Rekomendasi Otomatis (Auto Builder)
    Route::get('/autobuilder', [AutoBuilderController::class, 'index'])->name('autobuilder.index');
});