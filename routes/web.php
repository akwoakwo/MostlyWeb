<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SubpaketController;
use App\Http\Controllers\PemesananController;

// Route::get('/', function () {
//     return view('index');
// })->name('index');

// Rute untuk mengarahkan ke halaman login Google
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');

// Rute callback dari Google
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/desain-produk', [ProdukController::class, 'desainProduk'])->name('desain.produk');
Route::get('/list-produk', [ProdukController::class, 'produk'])->name('list.produk');
Route::get('/preview/{id}', [ProdukController::class, 'preview'])->name('preview');
Route::get('/preview-produk/{id}', [ProdukController::class, 'previewProduk'])->name('preview.produk');
Route::get('/pemesanan/{subpaket_id}', [PemesananController::class, 'pemesanan'])->name('pemesanan.form');
 Route::post('/pesen', [PemesananController::class, 'store'])->name('user.pesen');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Rute untuk notifikasi webhook dari Midtrans (tidak perlu otentikasi)
Route::post('/midtrans/notification', [PemesananController::class, 'paymentNotification']);


Route::middleware('auth')->group(function () {
    // customer
    Route::get('/profil-user', [UserController::class, 'profile'])->name('user');
    Route::put('/profil-user', [UserController::class, 'updateProfile'])->name('user.update');
    Route::get('/riwayat-pesan', [PemesananController::class, 'index'])->name('riwayat-pesan');
    Route::get('/review-pesan/{id}', [PemesananController::class, 'show'])->name('review-pesan');
    Route::post('/review-pesan', [ReviewController::class, 'store'])->name('review-pesan.store');

    // Rute untuk Pemesanan
    Route::get('/detail-pemesanan/{invoice_number}', [PemesananController::class, 'detail'])->name('pemesanan.detail');
    Route::post('/pemesanan/{invoice_number}/cancel', [PemesananController::class, 'cancel'])->name('pemesanan.cancel');
    Route::get('/resi/{invoice_number}', [PemesananController::class, 'resi'])->name('pemesanan.resi');

    // Rute Midtrans
    Route::post('/midtrans/checkout', [PemesananController::class, 'checkout']);
    Route::get('/thank-you/{invoice_number}', [PemesananController::class, 'thankYou'])->name('pemesanan.thankYou');
    
    // admin
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('/paket', PaketController::class)->names('paket');
    Route::post('/paket/{id}/subpaket', [PaketController::class, 'substore'])->name('paket.substore');
    Route::put('/paket/subupdate/{id}', [PaketController::class, 'subupdate'])->name('paket.subupdate');
    Route::delete('/paket/subdestory/{id}', [PaketController::class, 'subdestroy'])->name('paket.subdestroy');
    Route::resource('/show', SubpaketController::class)->names('show');
    Route::resource('/kategori', KategoriController::class)->names('kategori');
    Route::resource('/produk', ProdukController::class)->names('produk');
    Route::post('/produk/{id}/preview', [ProdukController::class, 'prestore'])->name('produk.prestore');
    Route::delete('produk/preview/{id}', [ProdukController::class, 'predestroy'])->name('produk.predestroy');
    Route::resource('/data-admin', AdminController::class)->names('data-admin');
    Route::resource('/ulasan', ReviewController::class)->names('ulasan');
    Route::resource('/faq', FaqController::class)->names('faq');
    Route::resource('/logo', LogoController::class)->names('logo');

    // Rute untuk halaman detail pemesanan
    Route::get('/admin/pemesanan', [PemesananController::class, 'adminPemesanan'])->name('admin.pemesanan.index');
    Route::get('/admin/pemesanan/{id}', [PemesananController::class, 'adminShowPemesanan'])->name('admin.pemesanan.show');
    Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::get('/admin/pembayaran/cetak', [PembayaranController::class, 'cetak'])->name('admin.pembayaran.cetak');
});
