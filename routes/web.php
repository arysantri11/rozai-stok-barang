<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BrgKeluarController;
use App\Http\Controllers\BrgMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
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
Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

/** Kategori mulai  */
Route::get('kategori', [KategoriController::class, 'index'])->name('kategori')->middleware('auth');
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store')->middleware('auth');
Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update')->middleware('auth');
Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('auth');
/** Kategori selesai */

/** Barang mulai  */
Route::get('barang', [BarangController::class, 'index'])->name('barang')->middleware('auth');
Route::post('barang', [BarangController::class, 'store'])->name('barang.store')->middleware('auth');
Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update')->middleware('auth');
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy')->middleware('auth');
/** Barang selesai */

/** Barang Masuk mulai  */
Route::get('brg-masuk', [BrgMasukController::class, 'index'])->name('brg-masuk')->middleware('auth');
Route::post('brg-masuk', [BrgMasukController::class, 'store'])->name('brg-masuk.store')->middleware('auth');
Route::put('brg-masuk/{id}', [BrgMasukController::class, 'update'])->name('brg-masuk.update')->middleware('auth');
Route::delete('brg-masuk/{id}', [BrgMasukController::class, 'destroy'])->name('brg-masuk.destroy')->middleware('auth');
/** Barang Masuk selesai */

/** Barang Keluar mulai  */
Route::get('brg-keluar', [BrgKeluarController::class, 'index'])->name('brg-keluar')->middleware('auth');
Route::post('brg-keluar', [BrgKeluarController::class, 'store'])->name('brg-keluar.store')->middleware('auth');
Route::put('brg-keluar/{id}', [BrgKeluarController::class, 'update'])->name('brg-keluar.update')->middleware('auth');
Route::delete('brg-keluar/{id}', [BrgKeluarController::class, 'destroy'])->name('brg-keluar.destroy')->middleware('auth');
/** Barang Keluar selesai */

/** User mulai  */
Route::get('user', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::post('user', [UserController::class, 'store'])->name('user.store')->middleware('auth');
Route::put('user/{id}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');
/** User selesai */

/** Barang Stok mulai  */
Route::get('stok', [StokController::class, 'index'])->name('stok')->middleware('auth');
/** Barang Stok selesai */

/** Login mulai  */
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate')->middleware('guest');
Route::get('logout', [AuthController::class, 'actionLogout'])->name('logout')->middleware('auth');
/** Login selesai */