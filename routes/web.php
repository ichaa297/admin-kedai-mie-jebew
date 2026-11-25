<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\FotoProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PengaturanTemaController;
use App\Http\Controllers\PengaturanFontController;
use App\Http\Controllers\PengaturanProfilController;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('backend.login');
});

// Login
Route::get('backend/login', [LoginController::class, 'loginBackend'])
    ->name('backend.login');

Route::post('backend/login', [LoginController::class, 'authenticateBackend'])
    ->name('backend.login.submit');

// Logout
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])
    ->name('backend.logout');


// Beranda: Admin dan Super Admin
Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')
    ->middleware(['auth', 'role:0,1']);

// Hak akses Super Admin
Route::middleware(['auth', 'role:1'])
    ->prefix('backend')
    ->name('backend.')
    ->group(function () {

        // CRUD Data User
        Route::resource('user', UserController::class);

        // Laporan User
        Route::get('laporan-user', [UserController::class, 'formUser'])
            ->name('laporan.formuser');

        Route::post('laporan-user/cetak', [UserController::class, 'cetakUser'])
            ->name('laporan.cetakuser');
    });

// Hak akses Admin dan Super Admin
Route::middleware(['auth', 'role:0,1'])
    ->prefix('backend')
    ->name('backend.')
    ->group(function () {

        // Pengaturan Profil
        Route::get('pengaturan-profil', [PengaturanProfilController::class, 'index'])
            ->name('pengaturan_profil.index');

        Route::post('pengaturan-profil', [PengaturanProfilController::class, 'update'])
            ->name('pengaturan_profil.update');

        // Pengaturan Tema
        Route::get('pengaturan-tema', [PengaturanTemaController::class, 'index'])
            ->name('pengaturan_tema.index');

        Route::post('pengaturan-tema', [PengaturanTemaController::class, 'update'])
            ->name('pengaturan_tema.update');

        // PENGATURAN FONT
        Route::get('pengaturan-font', [PengaturanFontController::class, 'index'])
            ->name('pengaturan_font.index');

        Route::post('pengaturan-font', [PengaturanFontController::class, 'update'])
            ->name('pengaturan_font.update');

        // CRUD Kategori
        Route::resource('kategori', KategoriController::class);

        // CRUD Produk
        Route::resource('produk', ProdukController::class);

        // Foto Produk
        Route::get('/foto-produk/{produk_id}', [FotoProdukController::class, 'index'])
            ->name('foto_produk.index');

        Route::post('/foto-produk/{produk_id}', [FotoProdukController::class, 'store'])
            ->name('foto_produk.store');

        Route::delete('/foto-produk/{id}', [FotoProdukController::class, 'destroy'])
            ->name('foto_produk.destroy');

        // Laporan Produk
        Route::get('laporan-produk', [ProdukController::class, 'formProduk'])
            ->name('laporan.formproduk');

        Route::post('laporan-produk/cetak', [ProdukController::class, 'cetakProduk'])
            ->name('laporan.cetakproduk');

        // Mengelola Pesanan
        Route::resource('pesanan', PesananController::class)
            ->except(['edit', 'destroy']);
        Route::get('/pesanan/{id}/struk', [PesananController::class, 'struk'])
            ->name('pesanan.struk');

        // Laporan Pesanan
        Route::get('laporan-pesanan', [PesananController::class, 'formPesanan'])
            ->name('laporan.formpesanan');

        Route::post('laporan-pesanan/cetak', [PesananController::class, 'cetakPesanan'])
            ->name('laporan.cetakpesanan');
    });

