<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BrgKeluarController;
use App\Http\Controllers\BrgMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StokController;
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

/** Barang Masuk mulai  */
Route::get('brg-masuk', [BrgMasukController::class, 'index'])->name('brg-masuk');
Route::post('brg-masuk', [BrgMasukController::class, 'store'])->name('brg-masuk.store');
Route::put('brg-masuk/{id}', [BrgMasukController::class, 'update'])->name('brg-masuk.update');
Route::delete('brg-masuk/{id}', [BrgMasukController::class, 'destroy'])->name('brg-masuk.destroy');
/** Barang Masuk selesai */

/** Barang Keluar mulai  */
Route::get('brg-keluar', [BrgKeluarController::class, 'index'])->name('brg-keluar');
Route::post('brg-keluar', [BrgKeluarController::class, 'store'])->name('brg-keluar.store');
Route::put('brg-keluar/{id}', [BrgKeluarController::class, 'update'])->name('brg-keluar.update');
Route::delete('brg-keluar/{id}', [BrgKeluarController::class, 'destroy'])->name('brg-keluar.destroy');
/** Barang Keluar selesai */

/** Barang Stok mulai  */
Route::get('stok', [StokController::class, 'index'])->name('stok');
/** Barang Stok selesai */