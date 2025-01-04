<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

// Rute Awal
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('auth.login');
});

// Rute Login dan Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Rute Logout (untuk user yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute yang Memerlukan Autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CategoryController::class, 'categoryChartData'])->name('dashboard');

    // Resource Routes
    Route::resource('/kategori', CategoryController::class)->names('kategori');
    Route::resource('/barang', BarangController::class);
    Route::resource('/barangmasuk', BarangMasukController::class);
    Route::resource('/barangkeluar', BarangKeluarController::class);
});
