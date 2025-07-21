<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RuanganBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Middleware\IsAdmin;





Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome'); 
Route::get('/ruangan/{id}', [DashboardController::class, 'show'])->name('ruangan');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin2', [DashboardController::class, 'indexxx'])->name('dashboard');




Route::resource('peminjaman', PeminjamanController::class);
Route::resource('pengembalian', PengembalianController::class);


Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', IsAdmin::class]
], function () {
    Route::resource('ruangan', RuanganController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('ruanganbarang', RuanganBarangController::class);
});
