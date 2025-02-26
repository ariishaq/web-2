<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\KaryawanController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// Routes for authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['role.karyawan:karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', [PenilaianController::class, 'karyawanGetBestEmployee'])->name('karyawan.best-employee');
    Route::get('/karyawan/penilaian', [PenilaianController::class, 'personalPenilaian'])->name('karyawan.personal-penilaian');
});

Route::middleware(['auth', 'hrd'])->group(function () {
    Route::get('/hrd/add-admin', [AuthController::class, 'showAddAdminForm']);
    Route::post('/hrd/add-admin', [AuthController::class, 'addAdmin']);

    Route::get('/hrd/dashboard', [HrdController::class, 'index'])->name('hrd.index');
    Route::get('/hrd/penilaian', [HrdController::class, 'hrdPenilaianIndex'])->name('hrd.penilaian');
    Route::get('/hrd/karyawan', [HrdController::class, 'hrdKaryawanIndex'])->name('hrd.karyawan.index');
    Route::get('/hrd/admin', [HrdController::class, 'hrdAdminIndex'])->name('hrd.admin.index');
    Route::get('/hrd/profile', [HrdController::class, 'hrdProfileShow'])->name('hrd.profile.show');

    Route::post('/hrd/change-password', [HrdController::class, 'changepassword'])->name('hrd.change-password');
    Route::get('/hrd/profile/edit', [HrdController::class, 'hrdProfileEdit'])->name('hrd.profile.edit');
    Route::post('/hrd/profile/update', [HrdController::class, 'hrdProfileUpdate'])->name('hrd.profile.update');

    Route::get('/hrd/best-employee', [PenilaianController::class, 'hrdGetBestEmployee'])->name('hrd.bestEmployee');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/change-password', [AdminController::class, 'changepassword'])->name('admin.change-password');
    Route::get('/admin/profile/edit', [AdminController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');

    Route::get('/admin/add-karyawan', [AuthController::class, 'showAddKaryawanForm'])->name('admin.addKaryawanForm');
    Route::post('/admin/add-karyawan', [AuthController::class, 'addKaryawan'])->name('admin.addKaryawan');
    Route::get('/admin/karyawan', [AuthController::class, 'karyawanIndex'])->name('admin.karyawanIndex');

    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian/{id}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

    Route::get('/penilaian/karyawan-terbaik', [PenilaianController::class, 'hitungKaryawanTerbaik'])->name('penilaian.terbaik');
    Route::get('/karyawan-terbaik', [PenilaianController::class, 'getBestEmployee'])->name('karyawan.terbaik');
});
