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
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::prefix('/dashboard')->group(function () {
    Route::resource('/home', DashboardController::class);

    Route::resource('/kegiatan', KegiatanController::class)->except(['create', 'show', 'edit']);

    Route::get('/kegiatan/export', [KegiatanController::class, 'exportExcel'])->name('kegiatan.export');

    Route::resource('/kegiatan/management', ManagementKegiatanController::class)->except(['create', 'show', 'edit']);

    Route::resource('/laporan', LaporanController::class)->except(['create', 'show', 'edit']);

    Route::resource('/user', UserController::class)->except(['create', 'show', 'edit']);
    Route::put('/user/{user}', [UserController::class, 'resetPasswordAdmin'])->name('user.resetPasswordAdmin');

    Route::resource('/profile', ProfileController::class)->except(['create', 'show', 'edit']);
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/{profile}', [ProfileController::class, 'resetPasswordUser'])->name('profile.resetPasswordUser');
})->middleware('auth');

// Route::fallback(function () {
//     return redirect()->route('login')->middleware('guest');
// });

// Route::fallback(function () {
//     if (session('url.intended')) {
//         return redirect(session('url.intended'));
//     } else {
//         return redirect()->route('login');
//     }
// });
