<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\cekout;
use Illuminate\Http\Request;
use App\Models\keranjang_layanan;
use App\Models\layanan;
use App\Models\User;

use function PHPSTORM_META\map;

class KeranjangLayananController extends Controller
{
    public function keranjang_layanan_tambah(Request $request)
    {
        $layanan = layanan::where('slug', $request->slug_layanan)->first();
        $user = User::where('email', $request->email)->first();

        // 1. cek apakah data layanan sudah ada didalam table keranjang
        $keranjang_layanan_user = keranjang_layanan::where('layanan_id', $layanan->id)->first();

        if ($keranjang_layanan_user == []) {
            $data_keranjang_layanan = [
                "user_id" => $user->id,
                "layanan_id" => $layanan->id,
                "status" => true
            ];
            keranjang_layanan::create($data_keranjang_layanan);

            return response()->json([
                'message' => 'success',
                'alert' => 'layanan berhasil ditambahkan dikeranjang anda',
            ]);
        }

        return response()->json([
            'message' => 'failed',
            'alert' => 'layanan sudah ada dalam keranjang',
        ]);
    }

    public function keranjang_layanan(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // $keranjang_layanan_user = keranjang_layanan::where('user_id', $user->id)->get();
        $keranjang_layanan_user_buka = keranjang_layanan::where([['user_id', $user->id], ['status', true]])->get();
        $keranjang_layanan_user_tutup = keranjang_layanan::where([['user_id', $user->id], ['status', false]])->get();

        $keranjang_layanan_user_buka_2 = $keranjang_layanan_user_buka->map(function ($keranjang, $key) {
            return [
                'id_keranjang_layanan' => $keranjang->id,
                'status' => $keranjang->status,
                'layanan' => layanan::where('id', $keranjang->layanan_id)->first()->nama
            ];
        });

        $keranjang_layanan_user_tutup_2 = $keranjang_layanan_user_tutup->map(function ($keranjang, $key) {
            return [
                'id_keranjang_layanan' => $keranjang->id,
                'status' => $keranjang->status,
                'layanan' => layanan::where('id', $keranjang->layanan_id)->first()->nama
            ];
        });


        return response()->json([
            'data_user' => $user,
            // 'data keranjang_all' => $keranjang_layanan_user_2,
            "data_keranjang_layanan_open" => $keranjang_layanan_user_buka_2,
            "data_keranjang_close" => $keranjang_layanan_user_tutup_2
        ]);
    }
}
