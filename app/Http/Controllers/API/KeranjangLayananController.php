<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\keranjang_layanan;
use App\Models\layanan;
use App\Models\User;

class KeranjangLayananController extends Controller
{
    public function keranjang_layanan_tambah(Request $request)
    {
        $layanan = layanan::where('slug', $request->slug_layanan)->first();
        $user = User::where('email', $request->email_user)->first();

        // saya asumsikan ada datadidalam nya(user dan layanan)--------------------------------
        // return response()->json([
        //     'layanan' => $layanan,
        //     'user' => $user,
        // ]);

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
}
