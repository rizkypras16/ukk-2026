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
use App\Controllers\PengaduanController;
use Sakuci\Route;

/*
|--------------------------------------------------------------------------
| Route Web
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/docs', [DocsController::class, 'index'])->name('docs');

/*
|--------------------------------------------------------------------------
| Login multi-role
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
| Route Pengaduan (Siswa / User)
|--------------------------------------------------------------------------
*/
Route::get('/pengaduan/tambah', [PengaduanController::class, 'create'])->name('pengaduan.create')->middleware('auth');
Route::post('/pengaduan/simpan', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('auth');
Route::get('/pengaduan/riwayat', [PengaduanController::class, 'index'])->name('pengaduan.riwayat')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Route Admin & CRUD (Dual Aliasing untuk mencegah error route tidak terdaftar)
|--------------------------------------------------------------------------
*/

// --- KATEGORI ---
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');

Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');

Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');

Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');

Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');

Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');


// --- ALAT ---
Route::get('/alat', [AlatController::class, 'index'])->name('alat.index');
Route::get('/alat', [AlatController::class, 'index'])->name('admin.alat.index');

Route::get('/alat/create', [AlatController::class, 'create'])->name('alat.create');
Route::get('/alat/create', [AlatController::class, 'create'])->name('admin.alat.create');

Route::post('/alat', [AlatController::class, 'store'])->name('alat.store');
Route::post('/alat', [AlatController::class, 'store'])->name('admin.alat.store');

Route::get('/alat/{id}/edit', [AlatController::class, 'edit'])->name('alat.edit');
Route::get('/alat/{id}/edit', [AlatController::class, 'edit'])->name('admin.alat.edit');

Route::put('/alat/{id}', [AlatController::class, 'update'])->name('alat.update');
Route::put('/alat/{id}', [AlatController::class, 'update'])->name('admin.alat.update');

Route::delete('/alat/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');
Route::delete('/alat/{id}', [AlatController::class, 'destroy'])->name('admin.alat.destroy');


// --- PENGGUNA ---
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna.index');

Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('admin.pengguna.create');

Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
Route::post('/pengguna', [PenggunaController::class, 'store'])->name('admin.pengguna.store');

Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');

Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');

Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');


/*
|--------------------------------------------------------------------------
| Route Admin Umum Lainnya
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

    Route::get('/database/export', [DatabaseController::class, 'export'])->name('admin.database.export');

    // Route Pengaduan Admin
    Route::get('/pengaduan', [PengaduanController::class, 'adminIndex'])->name('admin.pengaduan.index');
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'adminShow'])->name('admin.pengaduan.show');
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'adminUpdate'])->name('admin.pengaduan.update');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'adminDestroy'])->name('admin.pengaduan.destroy');
});