<?php

use App\Controllers\Core\AuthController;
use App\Controllers\Core\DashboardController;
use App\Controllers\Core\DatabaseController;
use App\Controllers\Core\DocsController;
use App\Controllers\Core\RoleController;
use App\Controllers\Core\UserController;
use App\Controllers\KategoriController;
use App\Controllers\PenggunaController;
use App\Controllers\AlatController;
use App\Controllers\AspirasiController;
use Sakuci\Route;

/*
|--------------------------------------------------------------------------
| Landing Page & Dokumentasi
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/docs', [DocsController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Authentikasi (Login & Register)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt')->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Route Akses Umum (Pengguna Login / Siswa)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {
    // Lihat Daftar Alat & Kategori untuk Siswa
    Route::get('/alat', [AlatController::class, 'index'])->name('alat.index');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    // Pengelolaan Aspirasi & Alias Pengaduan
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index')->name('pengaduan.index');
    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create')->name('pengaduan.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store')->name('pengaduan.store');
    Route::get('/aspirasi/{id_aspirasi}/edit', [AspirasiController::class, 'edit'])->name('aspirasi.edit')->name('pengaduan.edit');
    Route::put('/aspirasi/{id_aspirasi}', [AspirasiController::class, 'update'])->name('aspirasi.update')->name('pengaduan.update');
    Route::delete('/aspirasi/{id_aspirasi}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy')->name('pengaduan.destroy');
});

/*
|--------------------------------------------------------------------------
| Route Khusus ADMIN (Prefix: /admin)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Kelola Roles & System Users
    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/database/export', [DatabaseController::class, 'export'])->name('admin.database.export');

    // Kelola Kategori (CRUD Admin + Dual Alias)
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create')->name('admin.kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store')->name('admin.kategori.store');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit')->name('admin.kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update')->name('admin.kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy')->name('admin.kategori.destroy');

    // Kelola Pengguna (CRUD Admin + Dual Alias)
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index')->name('admin.pengguna.index');
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create')->name('admin.pengguna.create');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store')->name('admin.pengguna.store');
    Route::get('/pengguna/{pengguna}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit')->name('admin.pengguna.edit');
    Route::put('/pengguna/{pengguna}', [PenggunaController::class, 'update'])->name('pengguna.update')->name('admin.pengguna.update');
    Route::delete('/pengguna/{pengguna}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy')->name('admin.pengguna.destroy');

    // Kelola Alat (CRUD Admin + Dual Alias)
    Route::get('/alat/create', [AlatController::class, 'create'])->name('alat.create')->name('admin.alat.create');
    Route::post('/alat', [AlatController::class, 'store'])->name('alat.store')->name('admin.alat.store');
    Route::get('/alat/{alat}/edit', [AlatController::class, 'edit'])->name('alat.edit')->name('admin.alat.edit');
    Route::put('/alat/{alat}', [AlatController::class, 'update'])->name('alat.update')->name('admin.alat.update');
    Route::delete('/alat/{alat}', [AlatController::class, 'destroy'])->name('alat.destroy')->name('admin.alat.destroy');

    // Kelola Aspirasi & Alias Admin Pengaduan
    Route::get('/aspirasi', [AspirasiController::class, 'adminIndex'])->name('admin.aspirasi.index')->name('admin.pengaduan.index');
    Route::get('/aspirasi/{id_aspirasi}/edit', [AspirasiController::class, 'edit'])->name('admin.aspirasi.edit')->name('admin.pengaduan.edit');
    Route::put('/aspirasi/{id_aspirasi}', [AspirasiController::class, 'update'])->name('admin.aspirasi.update')->name('admin.pengaduan.update');
});

/*
|--------------------------------------------------------------------------
| Route Peran Otomatis (Generated Roles)
|--------------------------------------------------------------------------
*/
// @generated-roles:start
// @role:siswa:start
Route::group(['prefix' => 'siswa', 'middleware' => 'siswa'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('siswa.dashboard');
});
// @role:siswa:end
// @generated-roles:end