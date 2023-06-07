<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriLayananController;
use App\Http\Controllers\API\LayananController;
use App\Http\Controllers\API\JadwalOperasiController;
// use App\


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);                                //1. login page


// Route::get('/coba_api',function(){
//     return "Byajingan";
// });

Route::middleware(['middleware' => 'auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/layanan_rekomendasi', [LayananController::class, 'rekomendasi']);

    Route::get('/kategori_layanan_all', [KategoriLayananController::class, 'index']);
    Route::get('/kategori_layanan_layanan_all', [KategoriLayananController::class, 'kategori_layanan_layanan_all']);

    Route::get('/layanan', [LayananController::class, 'detail']);

    // ---------------------------------------------------------------------------------------------------------------------------

    Route::post('/cari_jadwal_operasi', [JadwalOperasiController::class, 'cari_jadwal']);

    // membuat api untuk keranjang layanan
    //membuat api untuk keranjang operasi
    // membuat api untuk transaksi

});
