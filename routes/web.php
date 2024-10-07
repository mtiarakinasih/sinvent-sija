<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

// Rute yang tidak memerlukan autentikasi
Route::get('/', function () {
    return view('welcome');
});

// Rute Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Rute Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Rute Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::resource('kategori', CategoryController::class);
});

route::resource('barang', BarangController::class);
Route::resource('barangmasuk', BarangMasukController::class);
route::resource('barangkeluar', BarangKeluarController::class);