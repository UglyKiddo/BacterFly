<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    AuthController,
    IndexController,
    DashboardController,
    ProfileController,
    InokulasiController,
    intruksiController,
    PengawasanController,
    ProduksiController,
    LabController,
    LabBakteriController,
    BidanController,
    ProsesController,
    BakteriController
};

// ========== AUTH ==========
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/lab-dashboard', [DashboardController::class, 'lab'])->name('lab.dashboard');
    Route::get('/produksi-dashboard', [DashboardController::class, 'produksi'])->name('produksi.dashboard');
    Route::get('/manager-dashboard', [DashboardController::class, 'manager'])->name('manager.dashboard');
});



Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/send-code', [AuthController::class, 'sendVerificationCode'])->name('send.code');

// ========== INDEX & DASHBOARD ==========
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// ========== PROFILE ==========
Route::prefix('profile')->middleware('auth')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
});

// ========== LAB ==========
Route::prefix('lab')->middleware('auth')->name('lab.')->group(function () {
    // Dashboard Lab
    Route::get('/dashboard', [LabController::class, 'dashboard'])->name('dashboard');

    // Data Bakteri
    Route::get('/bakteri', [LabController::class, 'bakteri'])->name('bakteri.index');

    Route::get('/intruksi', [LabController::class, 'intruksi'])->name('intruksi');

    Route::get('/profil', [LabController::class, 'profil'])->name('profil');


    // Tambah Bakteri
    Route::get('/tambah-bakteri', [LabController::class, 'showForm'])->name('bakteri.form');
    Route::prefix('lab')->middleware('auth')->name('lab.')->group(function () {
        Route::post('/proses-tambah-bakteri', [LabController::class, 'storeInokulasi'])->name('inokulasi.store');
    });

    // Kategori Bakteri
    Route::prefix('bakteri')->name('bakteri.')->group(function () {
        Route::get('/perikanan', [LabBakteriController::class, 'perikanan'])->name('perikanan');
        Route::get('/pertanian', [LabBakteriController::class, 'pertanian'])->name('pertanian');
        Route::get('/peternakan', [LabBakteriController::class, 'peternakan'])->name('peternakan');
    });
});

// ========== PRODUKSI ==========
Route::prefix('produksi')->middleware('auth')->name('produksi.')->group(function () {
    Route::get('/dashboard', fn () => view('pro_dashboard'))->name('dashboard');
    Route::get('/perikanan', [ProduksiController::class, 'perikanan'])->name('perikanan');
    Route::get('/pertanian', [ProduksiController::class, 'pertanian'])->name('pertanian');
    Route::get('/peternakan', [ProduksiController::class, 'peternakan'])->name('peternakan');
});

// ========== MANAGER ==========
Route::get('/manager-dashboard', fn () => view('man_dashboard'))
    ->middleware('auth')->name('manager.dashboard');

// ========== intruksi, INOKULASI, PENGAWASAN ==========
Route::middleware('auth')->group(function () {
    Route::get('/inokulasi', [InokulasiController::class, 'index'])->name('inokulasi');
    Route::get('/intruksi', [intruksiController::class, 'index'])->name('intruksi');
    Route::get('/pengawasan', [PengawasanController::class, 'index'])->name('pengawasan');
});

// ========== BIDAN ==========
Route::get('/bidan/pilih', [BidanController::class, 'pilih'])->middleware('auth')->name('bidan.pilih');

// ========== PROSES ==========
Route::prefix('proses')->middleware('auth')->name('proses.')->group(function () {
    Route::get('/eb', [ProsesController::class, 'eb'])->name('eb');
    Route::get('/tb', [ProsesController::class, 'tb'])->name('tb');
});

// ========== BAKTERI KHUSUS ==========
Route::get('/bakteri/tambah', [BakteriController::class, 'tambah'])->middleware('auth')->name('bakteri.tambah');