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
        // A.0 fitur pengubah data lampau antri menjadi tidak datang && jika tanggal lampau tanggal akan diubah menjadi false -----------------------------------------------------------------
        $jadwal_lampau = jadwal_operasi::whereDate('tanggal', '<', date('Y-m-d'));

        // A.1 mengubah jadwal lampau bernilai false ----------------------------------------------------------------------------
        $jadwal_lampau->where('status', true)->update(['status' => false]);

        // =============================================================================================================================

        // 1. jika request jadwal lampau maka fitur cari jadwal di berhentikan -----------------------
        $tanggal_besok     = date('Y-m-d', mktime(0, 0, 0, date("n"), date("j") + 1, date("Y")));
        $tanggal_request = date($request->tahun . "-" . $request->bulan . "-" . $request->hari);

        if ($tanggal_besok > $tanggal_request) {
            return response()->json([
                "status" => "failed",
                "message" => "tidak dapat mencari jadwal lampau, minimal pencarian 2 hari dari hari ini",
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
            'id_operasi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'error' => $validator->errors()
            ]);
        }
        //1.  cek email dan cek
        $user = auth()->user();

        // 2. validasi daya keranjang
        //  ctt : data yang masuk adalah data operasi yang sudah dibooking
        $cek_operasi_status_booking = operasi::where('id', $request->id_operasi)->first();

        if ($cek_operasi_status_booking->status == true) {
            return response()->json([
                'status' => "failed",
                "message" => "jadwal operasional sudah dibookiing"
            ]);
        }

        // 3. validasi data keranjang 2
        $user_keranjang_operasi_cek = keranjang_operasi::where([['user_id', $user->id], ['operasi_id', $request->id_operasi]])->first();
        if ($user_keranjang_operasi_cek != []) {
            return response()->json([
                'message' => "jadwal sudah ada didalam keranjang anda",
                "status" => "failed"
            ]);
        }

        keranjang_operasi::create(['user_id' => $user->id, 'operasi_id' => $request->id_operasi]);

        return response()->json([
            'status' => "success",
            "message" => "berhasil menambahkan "
        ]);
    }

    public function keranjang_operasi(Request $request) //mumet gaming
    {
        $user = auth()->user();

        $keranjang_operasi_user_buka = keranjang_operasi::where([
            ['user_id', $user->id],
            ['status', false]
        ])->orderBy('id', 'desc')->get();

        $keranjang_operasi_user_terblokir = keranjang_operasi::where([
            ['user_id', $user->id],
            ['status', true]
        ])->orderBy('id', 'desc')->get();

        return response()->json([
            'message' => 'success',
            'keranjang_operasi_buka' => $keranjang_operasi_user_buka,
            'keranjang_operasi_terblokir' => $keranjang_operasi_user_terblokir
        ]);
    }

    public function keranjang_operasi_hapus_terblokir(Request $request)
    {
        $user = auth()->user();

        keranjang_operasi::where([
            ['user_id', $user->id],
            ['status', true]
        ])->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil menghapus operasi yang terblokir pada keranjang anda'
        ]);
    }

    public function keranjang_operasi_user_hapus(Request $request)  //tidak digunakan
    {
        $keranjang_operasi = keranjang_operasi::where('id', $request->id_keranjang_operasi)->delete();

        return response()->json([
            'message' => 'success',
            'keranjang_operasi' => $keranjang_operasi
        ]);
    }
}
