<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jadwal_operasi;
use App\Models\keranjang_operasi;
use App\Models\operasi;
use App\Models\user;
use Illuminate\Http\Request;


class JadwalOperasiController extends Controller
{
    public function cari_jadwal(Request $request)
    {
        $tanggal_operasi = jadwal_operasi::whereDate('tanggal', date($request->tahun . "-" . $request->bulan . "-" . $request->hari))->first();

        if ($tanggal_operasi == null) {
            return response()->json([
                'message' => 'jadwal tidak ditemukan',
            ]);
        }

        $operasi = operasi::where('jadwal_operasi_id', $tanggal_operasi->id)->get();

        return response()->json([
            'message' => 'success',
            'tanggal_operasi' => $tanggal_operasi,
            'operasional' => $operasi
        ]);
    }

    public function keranjang_operasi_tambah(Request $request)
    {
        // diasumsikan data yang dikirimkan adalah data operasi sudah ada dalam table(tidak perlu cek)
        $user = User::where('email', $request->email)->first();
        $user_keranjang_operasi_cek = keranjang_operasi::where([['user_id', $user->id], ['operasi_id', $request->operasi_id]])->first();

        // return $user_keranjang_operasi_cek;

        if ($user_keranjang_operasi_cek != []) {
            return response()->json([
                'messsage' => "failed",
                "message_2" => "jadwal sudah ada didalam keranjang anda"
            ]);
        }

        keranjang_operasi::create(['user_id' => $user->id, 'operasi_id' => $request->operasi_id]);

        return response()->json([
            'messsage' => "success",
            "message_2" => "berhasil menambahkan "
        ]);


        // cek apakah sudah ada operasi didalam keranjang user

    }
}
