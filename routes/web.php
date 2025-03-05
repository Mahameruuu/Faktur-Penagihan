<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SparepartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupervisorController;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('role:admin|supervisor');

    Route::get('/penjualan/rekap', [PenjualanController::class, 'rekapPenjualan'])
        ->name('penjualan.rekap')
        ->middleware('role:admin|supervisor');

    Route::middleware(['auth', 'role:supervisor'])->group(function () {
        Route::get('/supervisor', [SupervisorController::class, 'index'])->name('supervisor.index');
        Route::post('/supervisor/verify/{id}', [SupervisorController::class, 'verify'])->name('supervisor.verify');
        Route::post('/supervisor/reject/{id}', [SupervisorController::class, 'reject'])->name('supervisor.reject');
    });

    Route::get('/sparepart/rekap-kuitansi', [SparepartController::class, 'rekapKuitansi'])
        ->name('sparepart.rekap-kuitansi')
        ->middleware('role:admin|supervisor');

    Route::resource('penjualan', PenjualanController::class)
        ->middleware('role:admin|supervisor');

    Route::resource('sparepart', SparepartController::class)
        ->except(['show'])
        ->middleware('role:admin|supervisor');

    Route::resource('admin', DashboardController::class)
        ->middleware('role:admin');

    Route::get('/penjualan/{id}/download-pdf', [PenjualanController::class, 'downloadPDF'])
        ->name('penjualan.downloadPDF')
        ->middleware('role:admin|supervisor');

    Route::get('/test-route', function () {
        return response()->json(['message' => 'Route test berhasil!']);
    })->middleware('role:admin|supervisor');
});
