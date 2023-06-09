<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriLayananController;
use App\Http\Controllers\API\LayananController;
use App\Http\Controllers\API\JadwalOperasiController;
use App\Http\Controllers\API\KeranjangLayananController;
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
    Route::get('/password-baru', [AuthController::class, 'password_baru']);

    Route::get('/layanan-rekomendasi', [LayananController::class, 'rekomendasi']);

    Route::get('/kategori-layanan-all', [KategoriLayananController::class, 'index']);
    Route::get('/kategori-layanan-layanan-all', [KategoriLayananController::class, 'kategori_layanan_layanan_all']);

    Route::get('/layanan', [LayananController::class, 'detail']);

    // ---------------------------------------------------------------------------------------------------------------------------

    Route::post('/cari-jadwal-operasi', [JadwalOperasiController::class, 'cari_jadwal']);
    Route::post('/jadwal-operasi-tambah', [JadwalOperasiController::class, 'keranjang_jadwal']);
    // keranjang operasi

    // membuat api untuk keranjang layanan
    Route::post('/keranjang-layanan-tambah', [KeranjangLayananController::class, 'keranjang_layanan_tambah']);
    Route::post('/keranjang-layanan-user', [KeranjangLayananController::class, 'keranjang_layanan']);  //dalam pengerjaan

    // membuat api untuk transaksi
    // Route::post('/', [KeranjangLayananController::class, 'keranjang_layanan']);  //dalam pengerjaan
    // menampilkan semua pesanan
});