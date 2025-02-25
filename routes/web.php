<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SparepartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Barryvdh\DomPDF\Facade\Pdf; 

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/sparepart/rekap-kuitansi', [SparepartController::class, 'rekapKuitansi'])->name('sparepart.rekap-kuitansi');

Route::resource('penjualan', PenjualanController::class);
Route::resource('sparepart', SparepartController::class)->except(['show']); 
Route::resource('admin', DashboardController::class);

Route::get('/penjualan/{id}/download-pdf', [PenjualanController::class, 'downloadPDF'])->name('penjualan.downloadPDF');

Route::get('/test-route', function () {
    return response()->json(['message' => 'Route test berhasil!']);
});
