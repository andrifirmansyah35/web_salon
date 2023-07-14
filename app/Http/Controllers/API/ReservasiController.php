<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jadwal_operasi;
use App\Models\keranjang_layanan;
use App\Models\keranjang_operasi;
use App\Models\layanan;
use App\Models\operasi;
use App\Models\reservasi;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPSTORM_META\map;

use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{

    public function reservasi_user_daftar()
    {
        $user = auth()->user();

        // 1. Fitur pengubah data reservasi lampau (antri ke tidak datang) #########################################
        $tanggal_hari_ini = date('Y-m-d');
        $cek_reservasi_lampau = jadwal_operasi::whereDate('tanggal', '<', $tanggal_hari_ini)->get();

        if ($cek_reservasi_lampau != []) {
            foreach ($cek_reservasi_lampau as $rt) {
                Reservasi::where('jadwal_operasi_id', $rt->id)->where('status', 'antri')
                    ->update(['status' => 'tidak datang']);
            }
        }
        // 1. Fitur pengubah data reservasi lampau (antri ke tidak datang) #########################################

        // 2. Fitur daftar reservasi ---------------------------------------------------------
        $reservasi_user = Reservasi::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $reservasi_user_komplit = $reservasi_user->map(function ($data) {
            $operasi_user = operasi::where('id', $data->operasi_id)->first();
            return  [
                "user_id" => $data->user_id,
                "user_nama" => User::where('id', $data->user_id)->first()->name,
                "layanan_id" => $data->layanan_id,
                "layanan_nama" => layanan::where('id', $data->layanan_id)->first()->nama,
                "operasi_id" => $data->operasi_id,
                "operasi" => $operasi_user->waktu_mulai . "-" . $operasi_user->waktu_selesai,
                "status" => $data->status,
            ];
        });

        return response()->json([
            "message" => "success",
            "reservasi_user_complete" => $reservasi_user_komplit    //belum bisa kita kembalikan karena akan menambahkan 
        ]);
    }


    public function reservasi_tambah(Request $request)
    {
        // 1. cek kelengapan request --------------------------------------------------------------------
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'id_operasi' => 'required',
            'id_layanan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'error' => $validator->errors()
            ]);
        }

        //2. saya asumsikan bahwa operasi dan layanan sudah (true) dapat dipesan dan operasi tidak digunakan
        $user = auth()->user();
        $jadwal_operasi_id = operasi::where('id', $request->id_operasi)->first()->jadwal_operasi_id;


        // 3. menambah data reservasi ---------------------------------------------------------------
        Reservasi::create([
            "jadwal_operasi_id" => $jadwal_operasi_id,
            "user_id" => $user->id,
            "layanan_id" => $request->id_layanan,
            "operasi_id" => $request->id_operasi,
            "status" => "antri"
        ]);

        // 4. update operasi untuk tidak dapat lagi dipesan 'dengan status true yg berarti sudah dibooking'
        operasi::where('id', $request->id_operasi)->update(['status' => true]);  //dibooking

        // 5.1 menghapus data keranjang layanan user yang reservasi
        keranjang_layanan::where([
            ['user_id', $user->id],
            ['layanan_id', $request->id_layanan]
        ])->delete();

        // 5.2 menghapus data keranjang operasi user       
        keranjang_operasi::where([
            ['user_id', $user->id],
            ['operasi_id', $request->id_operasi]
        ])->delete();

        // 6. mengupdate seluruhh keranjang operasi semua user
        keranjang_operasi::where('operasi_id', $request->id_operasi)->update(['status' => false]);

        return response()->json([
            "message" => "success",
            "message_2" => "Berhasil menambahkan reservasi",
        ]);
    }

    public function reservasi_pengajuan_batal(Request $request)
    {
        $user = auth()->user();

        Reservasi::where(
            ['id' => $request->reservasi_id],
            ['user_id' => $user->id]
        )->update(['status' => 'dibatalkan']);

        return response()->json([
            'message' => 'success',
            'message_2' => 'berhasil '
        ]);
    }

    public function reservasi_hapus(Request $request)
    {
        $user = auth()->user();

        Reservasi::where(
            ['id' => $request->reservasi_id],
            ['user_id' => $user->id]
        )->delete();

        return response()->json([
            'message' => 'success',
            'message_2' => 'berhasil menghapus'
        ]);
    }
}
