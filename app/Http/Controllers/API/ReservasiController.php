<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\keranjang_layanan;
use App\Models\keranjang_operasi;
use App\Models\operasi;
use App\Models\reservasi;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPSTORM_META\map;

class ReservasiController extends Controller
{

    public function reservasi_user_daftar(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $reservasi_user = Reservasi::where('user_id', $user->id)->get();

        $reservasi_user_komplit = $reservasi_user->map(function ($data) {
            return  [
                "user_id" => $data->user_member->name,
                "layanan_id" => $data->layanan_id,
                "operasi_id" => $data->operasi_id,
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
        //diasumsikan bahwa data layanan dan data operasi tidak false
        $user = User::where('email', $request->email)->first();

        $reservasi_user_cek = Reservasi::where([
            ["user_id", $user->id],
            ["layanan_id", $request->layanan_id],
            ["operasi_id", $request->operasi_id],
        ])->first();

        if ($reservasi_user_cek != []) {
            return response()->json([
                "message" => "failed",
                "message_2" => "reservasi sudah ada dalam layanan anda"
            ]);
        }

        Reservasi::create([
            "user_id" => $user->id,
            "layanan_id" => $request->layanan_id,
            "operasi_id" => $request->operasi_id,
            "status" => "antri"
        ]);

        // meng-update data operasi
        operasi::where('id', $request->operasi_id)->update(['status' => 'dibooking']); //fixx

        // // // // menghapus data keranjang layanan user yang reservasi
        keranjang_layanan::where([
            ['user_id', $user->id],
            ['layanan_id', $request->layanan_id]
        ])->delete();

        // // // menghapus data keranjang operasi user       
        keranjang_operasi::where([
            ['user_id', $user->id],
            ['operasi_id', $request->operasi_id]
        ])->delete();

        // // mengupdate seluruhh keranjang operasi semua user
        keranjang_operasi::where('operasi_id', $request->operasi_id)->update(['status' => false]);

        return response()->json([
            "message" => "success",
            "message_2" => "Berhasil menambahkan reservasi",
        ]);
    }

    public function reservasi_pengajuan_batal(Request $request)
    {
        $user = User::where('email', $request->email)->first();

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
        $user = User::where('email', $request->email)->first();

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
