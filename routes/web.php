<?php

use App\Http\Controllers\PengunjungController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PengunjungController::class, 'index'])->name('pengunjung.index');
Route::get('/beranda', [PengunjungController::class, 'index'])->name('pengunjung.beranda');
Route::get('/kategori/{kategori}', [PengunjungController::class, 'index'])->name('pengunjung.kategori');
Route::get('/artikel/{id}', [PengunjungController::class, 'show'])->name('pengunjung.detail');
