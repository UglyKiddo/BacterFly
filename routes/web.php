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
    ProduksiController,
    LabController,
    LabBakteriController,
    ProsesController,
    BakteriController
};

use App\Http\Controllers\Manager\{
ManagerController,
MProfileController,
MInstructionController,
PengawasanController,
PengawasanProduksiController,
PengawasanInokulasiController
};

// ========== AUTH ==========
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
    Route::post('/tambah-bakteri', [LabController::class, 'store'])->name('bakteri.store');

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

// Manager
Route::prefix('manager')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/profil', [MProfileController::class, 'show'])->name('manager.profil');
    Route::get('/profil/edit', [MProfileController::class, 'edit'])->name('manager.profil.edit');
    Route::post('/profil/update', [MProfileController::class, 'update'])->name('manager.profil.update');

    Route::get('/instruksi', [MInstructionController::class, 'index'])->name('manager.instruksi');
    Route::post('/instruksi', [MInstructionController::class, 'store'])->name('manager.instruksi.store');
    Route::get('/instruksi/detail/{id}', [MInstructionController::class, 'show'])->name('manager.instruksi.detail');
    Route::get('/instruksi/edit/{id}', [MInstructionController::class, 'edit'])->name('manager.instruksi.edit');
    Route::post('/instruksi/update/{id}', [MInstructionController::class, 'update'])->name('manager.instruksi.update');
    Route::get('/instruksi/done/{id}', [MInstructionController::class, 'markAsDone'])->name('manager.instruksi.done');
    Route::get('/instruksi/delete/{id}', [MInstructionController::class, 'destroy'])->name('manager.instruksi.delete');

    Route::get('/pengawasan', [PengawasanController::class, 'index'])->name('manager.pengawasan');

    Route::prefix('pengawasan/produksi')->name('manager.pengawasan.produksi.')->group(function () {
    Route::get('/', [PengawasanProduksiController::class, 'index'])->name('index');
    Route::get('/{kategori}', [PengawasanProduksiController::class, 'showByKategori'])->name('kategori');
    });
    
    Route::prefix('pengawasan/inokulasi')->name('manager.pengawasan.inokulasi.')->middleware(['auth'])->group(function () {
    Route::get('/', [PengawasanInokulasiController::class, 'index'])->name('index');
    Route::get('/{kategori}', [PengawasanInokulasiController::class, 'showByKategori'])->name('kategori');
    });

   


});


// ========== PROSES ==========
Route::prefix('proses')->middleware('auth')->name('proses.')->group(function () {
    Route::get('/eb', [ProsesController::class, 'eb'])->name('eb');
    Route::get('/tb', [ProsesController::class, 'tb'])->name('tb');
});

// ========== BAKTERI KHUSUS ==========
Route::get('/bakteri/tambah', [BakteriController::class, 'tambah'])->middleware('auth')->name('bakteri.tambah');
