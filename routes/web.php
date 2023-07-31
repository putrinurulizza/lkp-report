<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagementKegiatanController;
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


Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::prefix('/dashboard')->group(function () {
    Route::resource('/home', DashboardController::class)->middleware('auth');

    Route::resource('/kegiatan', KegiatanController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('laporan.export')->middleware('auth');

    Route::resource('/kegiatan/management', ManagementKegiatanController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/laporan', LaporanController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/user', UserController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    Route::put('/user/{user}', [UserController::class, 'resetPasswordAdmin'])->name('user.resetPasswordAdmin')->middleware('auth');

    Route::resource('/profile', ProfileController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::post('/profile/{profile}', [ProfileController::class, 'resetPasswordUser'])->name('profile.resetPasswordUser')->middleware('auth');
});

// Route::fallback(function () {
//     return redirect()->route('login')->middleware('guest');
// });
