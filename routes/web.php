<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\KategoriOperasiController;
use App\Http\Controllers\SkemaOperasiController;
use App\Http\Controllers\OperasiController;
use App\Http\Controllers\UserController;


// sengaja belum digunakan karena untuk dapat menggunakan 
Route::get('/dashboard', [DashboardController::class,'index']);

Route::middleware(['auth'])->group(function () {
    
Route::get('/kategori_layanan/checkSlug',[KategoriLayananController::class,'checkSlug']);
Route::resource('/kategori_layanan', KategoriLayananController::class);

// Route::get('/layanan/checkSlug',[LayananController::class,'checkSlug']);
Route::get('/layanan/status/{layanan:slug}',[LayananController::class,'updateStatus']);
Route::get('/layanan/status2/{layanan:slug}',[LayananController::class,'updateStatus2']);
Route::resource('/layanan', LayananController::class);

Route::resource('/kategori_operasi', KategoriOperasiController::class);

Route::post('/tambah_skema_operasi',[SkemaOperasiController::class,'tambahSkemaOperasi']);
Route::delete('/skema_operasi_hapus',[SkemaOperasiController::class,'hapusSkemaOperasi']);

Route::resource('/jadwal_operasi', JadwalOperasiController::class);
Route::get('jadwal_operasi_status/{jadwal_operasi:tanggal}',[JadwalOperasiController::class,'updateStatus']);
Route::delete('jadwal_operasi_hapus/{jadwal_operasi:tanggal}',[JadwalOperasiController::class,'hapusJadwal']);
    
Route::get('/jadwal_operasi_detail/{jadwal_operasi:tanggal}',[OperasiController::class,'detail']); 



// userController -------------------------------------------------------------------------------------------------
Route::get('/profile',[UserController::class,'userProfile']);

Route::get('/daftar_pelanggan',[UserController::class,'pelangan']);
Route::get('/pelanggan/{user:email}',[UserController::class,'pelanganInfo']);
Route::get('/pelanggan_tambah',[UserController::class,'pelangganTambah']); 
Route::post('/pelanggan_tambah',[UserController::class,'pelanganSimpan']); 
Route::post('/pelanggan_jadi_member',[UserController::class,'pelanganJadiMember']); 

Route::get('/daftar_member',[UserController::class,'member']); 
Route::get('/member/{user:email}',[UserController::class,'memberInfo']);

Route::middleware(['pemilik'])->group(function () {
    Route::get('/daftar_admin',[UserController::class,'admin']); 
    Route::get('/admin/{user:email}',[UserController::class,'adminInfo']);
    Route::get('/admin_tambah',[UserController::class,'adminTambah']); 
    Route::post('/admin_tambah',[UserController::class,'adminSimpan']);
    Route::get('/admin_status/{user:email}',[UserController::class,'adminStatus']);
});

Route::get('/profile',[UserController::class,'userInfo']);
Route::get('/profile_edit',[UserController::class,'userEdit']);
Route::put('/profile_update',[UserController::class,'userUpdate']);

Route::get('/logout',[LoginController::class,'logout']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'autentikasi']);    
});