<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\BrowsingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchingController;
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
Route::get('/dashboard', [DashboardController::class,'index']);
Route::get('/pencarian', [SearchingController::class, 'searching']);
Route::get('/penjelajahan', [BrowsingController::class, 'browsing']);
Route::get('/rekomendasi', [RekomendasiController::class, 'rekomendasi']);
Route::get('/detail-destinasi/{namaDestinasi}', [DetailController::class,'index']);
