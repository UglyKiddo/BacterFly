<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    AuthController,
    IndexController,
    DashboardController,
    intruksiController,
    ProsesController,
};

use App\Http\Controllers\Lab\{
LabController,
LabProfileController,
LabInstructionController,
LabBakteriController,
};

use App\Http\Controllers\Manager\{
ManagerController,
MProfileController,
MInstructionController,
PengawasanController,
PengawasanProduksiController,
PengawasanInokulasiController
};

use App\Http\Controllers\Produksi\{
ProController,
ProProfileController,
ProInstructionController,
ProBakteriController
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
    Route::get('/dashboard', [LabController::class, 'dashboard'])->name('dashboard');

    Route::get('/profil', [LabProfileController::class, 'show'])->name('profil');
    Route::get('/profil/edit', [LabProfileController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [LabProfileController::class, 'update'])->name('profil.update');

    Route::get('/instruksi', [LabInstructionController::class, 'index'])->name('instruksi.index');
    Route::get('/instruksi/detail/{id}', [LabInstructionController::class, 'show'])->name('instruksi.detail');
    Route::get('/instruksi/done/{id}', [LabInstructionController::class, 'markAsDone'])->name('instruksi.done');

    Route::get('/bakteri', [LabBakteriController::class, 'index'])->name('bakteri.index');
    Route::get('/bakteri/{kategori}', [LabBakteriController::class, 'kategori'])->name('bakteri.kategori');
    Route::get('/bakteri/{kategori}/tambah', [LabBakteriController::class, 'create'])->name('bakteri.create');
    Route::post('/bakteri/{kategori}', [LabBakteriController::class, 'store'])->name('bakteri.store');
    Route::get('/bakteri/{id}/edit', [LabBakteriController::class, 'edit'])->name('bakteri.edit');
    Route::put('/bakteri/{id}', [LabBakteriController::class, 'update'])->name('bakteri.update');
    Route::delete('/bakteri/{id}', [LabBakteriController::class, 'destroy'])->name('bakteri.destroy');
});

// ========== PRODUKSI ==========
Route::prefix('produksi')->middleware('auth')->name('produksi.')->group(function () {
    Route::get('/dashboard', [ProController::class, 'dashboard'])->name('dashboard');

    Route::get('/proprofil', [ProProfileController::class, 'show'])->name('proprofil');
    Route::get('/proprofil/edit', [ProProfileController::class, 'edit'])->name('proprofil.edit');
    Route::post('/proprofil/update', [ProProfileController::class, 'update'])->name('proprofil.update');

    Route::get('/proinstruksi', [ProInstructionController::class, 'index'])->name('proinstruksi.index');
    Route::get('/proinstruksi/detail/{id}', [ProInstructionController::class, 'show'])->name('proinstruksi.detail');
    Route::get('/proinstruksi/done/{id}', [ProInstructionController::class, 'markAsDone'])->name('proinstruksi.done');

    Route::get('probakteri', [ProBakteriController::class, 'index'])->name('probakteri.index');
    Route::get('probakteri/{kategori}', [ProBakteriController::class, 'kategori'])->name('probakteri.kategori');
    Route::get('probakteri/{kategori}/tambah', [ProBakteriController::class, 'create'])->name('probakteri.create');
    Route::post('probakteri/{kategori}', [ProBakteriController::class, 'store'])->name('probakteri.store');
    Route::get('probakteri/{id}/edit', [ProBakteriController::class, 'edit'])->name('probakteri.edit');
    Route::put('probakteri/{id}', [ProBakteriController::class, 'update'])->name('probakteri.update');
    Route::delete('probakteri/{id}', [ProBakteriController::class, 'destroy'])->name('probakteri.destroy');
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