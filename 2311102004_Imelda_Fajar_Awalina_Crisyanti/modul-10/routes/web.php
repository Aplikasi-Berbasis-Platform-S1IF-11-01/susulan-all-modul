<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;

// Route halaman utama
Route::get('/', [ProfilController::class, 'index']);

// Route pengganti data.php — dipanggil oleh AJAX
Route::get('/data', [ProfilController::class, 'getData']);