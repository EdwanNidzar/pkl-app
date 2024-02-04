<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\PelanggaranController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('parpols', ParpolController::class)->middleware(['auth', 'verified','role:bawaslu-provinsi']);

Route::resource('jenispelanggaran', JenisPelanggaranController::class)->middleware(['auth', 'verified','role:bawaslu-provinsi']);

Route::resource('pelanggaran', PelanggaranController::class)->middleware(['auth', 'verified','role:bawaslu-provinsi|bawaslu-kota']);

Route::get('provinsi', function () {
    return '<h1>Welcome Bawaslu Provinsi</h1>';
})->middleware(['auth', 'verified','role:bawaslu-provinsi']);

Route::get('kota', function () {
    return '<h1>Welcome Bawaslu Kota</h1>';
})->middleware(['auth', 'verified','role:bawaslu-kota|bawaslu-provinsi']);

require __DIR__.'/auth.php';
