<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\PenjelajahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\RekomendasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class,'landingPage']);
Route::get('/pencarian', [PencarianController::class, 'searching']);
Route::get('/rekomendasi', [RekomendasiController::class, 'rekomendasi']);
Route::get('/penjelajahan', [PenjelajahanController::class, 'browsing']);
Route::get('/dashboard', [DashboardController::class,'index']);
Route::get('/detail/{nama_wisata}', [DetailController::class, 'detail']);
Route::get('/jelajah/{kriteria}/{jelajah}',[PenjelajahanController::class,'jelajah']);
