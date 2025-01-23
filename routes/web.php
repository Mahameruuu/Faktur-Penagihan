<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenjualanController;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('admin', AdminController::class);
Route::resource('penjualan', PenjualanController::class);
Route::get('/penjualan/{id}/download-pdf', [PenjualanController::class, 'downloadPDF'])->name('penjualan.downloadPDF');
