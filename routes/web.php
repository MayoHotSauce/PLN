<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\Route;

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

// Routes untuk guest
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Cek Tagihan routes
Route::get('/cek-tagihan', [TagihanController::class, 'index'])->name('cek-tagihan');
Route::get('/cek-tagihan/search', [TagihanController::class, 'search'])->name('cek-tagihan.search');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('tarif', TarifController::class);
    Route::resource('pemakaian', PemakaianController::class);
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/pemakaian/{pemakaian}/pay', [PemakaianController::class, 'pay'])->name('pemakaian.pay');
});

Route::post('/cek-tagihan', [TagihanController::class, 'cekTagihan'])->name('cek-tagihan');

require __DIR__.'/auth.php';
