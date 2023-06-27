<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
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

// Route::get('/', function () {
//     return view('component.main');
// });

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::prefix('/dashboard')->group(function () {
    Route::resource('/home', DashboardController::class)->middleware('auth');

    Route::resource('/kegiatan', KegiatanController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/laporan', LaporanController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::prefix('/user')->group(function () {
        Route::resource('/profile', ProfileController::class)->except(['create', 'show', 'edit'])->middleware('auth');
        Route::resource('/settings', SettingsController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    });
});

// Route::fallback(function () {
//     return redirect()->route('login');
// });

// Route::fallback(function () {
//     if (session('url.intended')) {
//         return redirect(session('url.intended'));
//     } else {
//         return redirect()->route('login');
//     }
// });
