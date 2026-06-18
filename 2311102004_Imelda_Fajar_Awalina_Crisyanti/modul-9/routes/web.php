<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiMahasiswaController;

Route::get('/', [NilaiMahasiswaController::class, 'index']);
Route::get('/nilai', [NilaiMahasiswaController::class, 'index'])->name('nilai.index');