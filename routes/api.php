<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriLayananController;
use App\Http\Controllers\API\LayananController;
use App\Http\Controllers\API\JadwalOperasiController;
use App\Http\Controllers\API\KeranjangLayananController;
use App\Http\Controllers\API\ReservasiController;

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

Route::middleware(['middleware' => 'auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/password-baru', [AuthController::class, 'password_baru']);

    Route::get('/layanan-rekomendasi', [LayananController::class, 'rekomendasi']);

    Route::get('/kategori-layanan-all', [KategoriLayananController::class, 'index']);
    Route::get('/kategori-layanan-layanan-all', [KategoriLayananController::class, 'kategori_layanan_layanan_all']);

    Route::get('/layanan', [LayananController::class, 'detail']);

    // ---------------------------------------------------------------------------------------------------------------------------

    // api operasi -----------------------------
    Route::post('/cari-jadwal-operasi', [JadwalOperasiController::class, 'cari_jadwal']);
    Route::post('/keranjang-operasi-tambah', [JadwalOperasiController::class, 'keranjang_operasi_tambah']);
    Route::post('/keranjang-operasi-user', [JadwalOperasiController::class, 'keranjang_operasi']);
    Route::post('/keranjang-operasi-terblokir-hapus', [JadwalOperasiController::class, 'keranjang_operasi_hapus_terblokir']);   //belm di cek
    Route::post('/keranjang-operasi-user-hapus', [JadwalOperasiController::class, 'keranjang_operasi_user_hapus']);

    // membuat api untuk keranjang layanan---------------------------------------------------------
    Route::post('/keranjang-layanan-tambah', [KeranjangLayananController::class, 'keranjang_layanan_tambah']);
    Route::get('/keranjang-layanan-user', [KeranjangLayananController::class, 'keranjang_layanan']);

    // membuat api untuk reservasi
    Route::post('/reservasi-user-daftar', [ReservasiController::class, 'reservasi_user_daftar']);
    Route::post('/reservasi-tambah', [ReservasiController::class, 'reservasi_tambah']);
    Route::post('/reservasi-pengajuan-batal', [ReservasiController::class, '']);
    Route::post('/reservasi-hapus', [ReservasiController::class, '']);
});
