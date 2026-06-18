<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

// Halaman awal otomatis diarahkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Autentikasi (Hanya untuk tamu / belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

// Rute Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Terproteksi (Wajib Login)
Route::middleware(['auth'])->group(function () {

    // KELOMPOK RUTE ADMIN (Pemilik Toko Alat Pancing)
    Route::middleware(['role:admin'])->group(function () {
        // Rute Dashboard Utama Admin (Statistik & Grafik Ringkas)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Rute CRUD Otomatis untuk Inventaris Alat Pancing
        Route::resource('products', ProductController::class);
    });

    // KELOMPOK RUTE USER (Pembeli / Angler)
    Route::middleware(['role:user'])->group(function () {
        Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
        Route::post('/shop/buy/{product}', [ShopController::class, 'buy'])->name('shop.buy');
    });
});