<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** Halaman Utama */
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/** Kategori mulai  */
Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
/** Kategori selesai */

/** Barang mulai  */
Route::get('barang', [BarangController::class, 'index'])->name('barang');
Route::post('barang', [BarangController::class, 'store'])->name('barang.store');
Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
/** Barang selesai */