<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jadwal_operasi;
use App\Models\keranjang_operasi;
use App\Models\operasi;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JadwalOperasiController extends Controller
{
    public function cari_jadwal(Request $request)
    {
        // 1. jika request jadwal lampau maka fitur cari jadwal di berhentikan -----------------------
        $tanggal_besok     = date('Y-m-d', mktime(0, 0, 0, date("n"), date("j") + 1, date("Y")));
        $tanggal_request = date($request->tahun . "-" . $request->bulan . "-" . $request->hari);

        if ($tanggal_besok > $tanggal_request) {
            return response()->json([
                "message_1" => "tidak dapat mencari jadwal lampau",
                "message_2" => "minimal pencarian 2 hari dari hari ini",
                "tanggal request" => $tanggal_request,
                "tanggal besok" => $tanggal_besok
            ]);
        }

        $tanggal_operasi = jadwal_operasi::where('status', true)->whereDate('tanggal', date($request->tahun . "-" . $request->bulan . "-" . $request->hari))->first();

        if ($tanggal_operasi == []) {
            return response()->json([
                'message' => 'jadwal operasional kosong',
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
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'id_operasi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'error' => $validator->errors()
            ]);
        }
        //1.  cek email dan cek
        $user = User::where('email', $request->email)->first();

        // 2. validasi daya keranjang
        //  ctt : data yang masuk adalah data operasi yang sudah dibooking
        $cek_operasi_status_booking = operasi::where('id', $request->id_operasi)->first();

        if ($cek_operasi_status_booking->status == 1) {
            return response()->json([
                'messsage' => "failed",
                "message_2" => "jadwal operasional sudah dibookiing"
            ]);
        }

        // 3. validasi data keranjang 2
        $user_keranjang_operasi_cek = keranjang_operasi::where([['user_id', $user->id], ['operasi_id', $request->id_operasi]])->first();
        if ($user_keranjang_operasi_cek != []) {
            return response()->json([
                'messsage' => "failed",
                "message_2" => "jadwal sudah ada didalam keranjang anda"
            ]);
        }

        keranjang_operasi::create(['user_id' => $user->id, 'operasi_id' => $request->id_operasi]);

        return response()->json([
            'messsage' => "success",
            "message_2" => "berhasil menambahkan "
        ]);
    }

    public function keranjang_operasi(Request $request) //mumet gaming
    {
        $user = User::where('email', $request->email)->first();

        $keranjang_operasi_user_buka = keranjang_operasi::where([
            ['user_id', $user->id],
            ['status', 0]
        ])->get();

        $keranjang_operasi_user_terblokir = keranjang_operasi::where([
            ['user_id', $user->id],
            ['status', 1]
        ])->get();

        return response()->json([
            'message' => 'success',
            'keranjang_operasi_buka' => $keranjang_operasi_user_buka,
            'keranjang_operasi_terblokir' => $keranjang_operasi_user_terblokir
        ]);
    }

    public function keranjang_operasi_hapus_terblokir(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        keranjang_operasi::where([
            ['user_id', $user->id],
            ['status', false]
        ])->delete();

        return response()->json([
            'message' => 'success',
            'message_2' => 'berhasil menghapus operasi yang terblokir pada keranjang anda'
        ]);
    }

    public function keranjang_operasi_user_hapus(Request $request)  //tidak digunakan
    {
        $keranjang_operasi = keranjang_operasi::where('id', $request->keranjang_operasi_id)->delete();

        return response()->json([
            'message' => 'success',
            'keranjang_operasi' => $keranjang_operasi
        ]);
    }
}
