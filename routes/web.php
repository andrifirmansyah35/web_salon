<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\JadwalOperasiController;
use App\Http\Controllers\KategoriOperasiController;
use App\Http\Controllers\SkemaOperasiController;
use App\Http\Controllers\OperasiController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

// mencoba menggunakan email 
use App\Http\Controllers\EmailTestController;

use App\Models\kategori_layanan;




// mencoba email ----------------------------------------------------------
route::get('/email-test', [EmailTestController::class, 'index']);
route::get('/email-test-kedua', [EmailTestController::class, 'kedua']);


// sengaja belum digunakan karena untuk dapat menggunakan 
Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('index', [
            'title' => 'Halaman Dashboard',
            'kategori_layanan' => kategori_layanan::all()
        ]);
    });

    Route::get('/kategori_layanan/checkSlug', [KategoriLayananController::class, 'checkSlug']);
    Route::resource('/kategori_layanan', KategoriLayananController::class);

    // Route::get('/layanan/checkSlug',[LayananController::class,'checkSlug']);
    Route::get('/layanan/status/{layanan:slug}', [LayananController::class, 'updateStatus']);
    Route::get('/layanan/status2/{layanan:slug}', [LayananController::class, 'updateStatus2']);
    Route::resource('/layanan', LayananController::class);

    Route::resource('/kategori_operasi', KategoriOperasiController::class);

    Route::post('/tambah_skema_operasi', [SkemaOperasiController::class, 'tambahSkemaOperasi']);
    Route::delete('/skema_operasi_hapus', [SkemaOperasiController::class, 'hapusSkemaOperasi']);

    Route::resource('/jadwal_operasi', JadwalOperasiController::class);
    Route::get('jadwal_operasi_status/{jadwal_operasi:tanggal}', [JadwalOperasiController::class, 'updateStatus']);
    Route::delete('jadwal_operasi_hapus/{jadwal_operasi:tanggal}', [JadwalOperasiController::class, 'hapusJadwal']);

    Route::get('/jadwal_operasi_detail/{jadwal_operasi:tanggal}', [OperasiController::class, 'detail']);

    // reservasi controller ------------------------------------------------------------------------------------------
    Route::get('/reservasi', [ReservasiController::class, 'reservasi']);
    Route::get('/reservasi_mendatang', [ReservasiController::class, 'reservasi_mendatang']);
    Route::put('/reservasi_status', [ReservasiController::class, 'reservasi_status']);
    Route::get('/reservasi_konfirmasi_pembayaran/{reservasi:id}', [ReservasiController::class, 'konfirmasi_pembayaran']);

    // Laporan Controller ----------------------------------------------------------------------------------------------
    Route::get('/laporan_reservasi', [LaporanController::class, 'laporan_reservasi']);
    Route::post('/reservasi_laporan_set_waktu', [LaporanController::class, 'reservasi_laporan_set_waktu']); //on progress
    Route::get('/print_laporan_reservasi', [LaporanController::class, 'print_laporan_reservasi']);

    Route::get('/print_resevasi', [LaporanController::class, 'print_reservasi']);
    Route::get('/print_daftar_layanan', [LaporanController::class, 'print_daftar_layanan']);

    // userController -------------------------------------------------------------------------------------------------
    Route::get('/profile', [UserController::class, 'userProfile']);

    Route::get('/daftar_pelanggan', [UserController::class, 'pelangan']);
    Route::get('/pelanggan/{user:email}', [UserController::class, 'pelanganInfo']);
    Route::get('/pelanggan_tambah', [UserController::class, 'pelangganTambah']);
    Route::post('/pelanggan_tambah', [UserController::class, 'pelanganSimpan']);
    Route::post('/pelanggan_jadi_member', [UserController::class, 'pelanganJadiMember']);

    Route::get('/daftar_member', [UserController::class, 'member']);
    Route::get('/member/{user:email}', [UserController::class, 'memberInfo']);

    Route::middleware(['pemilik'])->group(function () {
        Route::get('/daftar_admin', [UserController::class, 'admin']);
        Route::get('/admin/{user:email}', [UserController::class, 'adminInfo']);
        Route::get('/admin_tambah', [UserController::class, 'adminTambah']);
        Route::post('/admin_tambah', [UserController::class, 'adminSimpan']);
        Route::get('/admin_status/{user:email}', [UserController::class, 'adminStatus']);
    });



    Route::get('/profile', [UserController::class, 'userInfo']);
    Route::get('/profile_edit', [UserController::class, 'userEdit']);
    Route::put('/profile_update', [UserController::class, 'userUpdate']);

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'autentikasi']);
});

Route::get('kategori_layanan_print', [KategoriLayananController::class, 'print_data_all']);
