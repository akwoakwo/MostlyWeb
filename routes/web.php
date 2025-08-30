<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemesananController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/produk', [ProdukController::class, 'produk'])->name('produk');
Route::get('/preview/{id}', [ProdukController::class, 'preview'])->name('preview');
Route::get('/pemesanan/{id}', [PemesananController::class, 'pemesanan'])->name('pemesanan');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // customer
    Route::get('/profil-user', [UserController::class, 'profile'])->name('user');
    Route::put('/profil-user', [UserController::class, 'updateProfile'])->name('user.update');
    Route::get('/riwayat-pesan', function () {
        return view('customer/riwayat_pesan');
    });

    // admin
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/paket', [PaketController::class, 'index'])->name('paket');
});
