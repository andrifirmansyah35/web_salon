<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\cekout;
use App\Models\kategori_layanan;
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
        $user = auth()->user();

        // 1. cek apakah data layanan sudah ada didalam table keranjang
        $keranjang_layanan_user = keranjang_layanan::where('layanan_id', $layanan->id)->first();

        if ($keranjang_layanan_user == []) {
            $data_keranjang_layanan = [
                "user_id" => $user->id,
                "layanan_id" => $layanan->id,
                "status" => true
            ];
            $data = keranjang_layanan::create($data_keranjang_layanan);
            $kategori_layanan = kategori_layanan::where('id', $data->layanan->kategori_layanan_id)->first();

            $dataKeranjang = [
                'id_keranjang_layanan' => $data->id,
                'status' => $data->status,
                'layanan' => $data->layanan->nama,
                'kategori_layanan' => $kategori_layanan->nama,
                'gambar_kategori_layanan' => $kategori_layanan->gambar,
                'harga' => $data->layanan->harga,
            ];
            return response()->json([
                'message' => 'success',
                'alert' => 'layanan berhasil ditambahkan dikeranjang anda',
                'data' => $dataKeranjang,
            ]);
        }

        return response()->json([
            'message' => 'failed',
            'alert' => 'layanan sudah ada dalam keranjang',
        ]);
    }

    public function keranjang_layanan(Request $request)
    {
        $user = auth()->user();

        $keranjang_layanan_user_buka = keranjang_layanan::where([['user_id', $user->id], ['status', true]])->get();
        $keranjang_layanan_user_tutup = keranjang_layanan::where([['user_id', $user->id], ['status', false]])->get();

        $keranjang_layanan_user_buka_2 = $keranjang_layanan_user_buka->map(function ($keranjang, $key) {
            $layanan = layanan::where('id', $keranjang->layanan_id)->first();

            return [
                'id_keranjang_layanan' => $keranjang->id,
                'status' => $keranjang->status,
                'gambar_kategori_layanan' => $layanan->kategori_layanan->gambar,
                'layanan' => $layanan->nama,
                'kategori_layanan' => $layanan->kategori_layanan->nama,
                'harga' => $layanan->harga
            ];
        });

        $keranjang_layanan_user_tutup_2 = $keranjang_layanan_user_tutup->map(function ($keranjang, $key) {
            $layanan = layanan::where('id', $keranjang->layanan_id)->first();
            return [
                'id_keranjang_layanan' => $keranjang->id,
                'status' => $keranjang->status,
                'gambar_kategori_layanan' => $layanan->kategori_layanan->gambar,
                'layanan' => $layanan->nama,
                'kategori_layanan' => $layanan->kategori_layanan->nama,
                'harga' => $layanan->harga
            ];
        });

        return response()->json([
            'data_user' => $user,
            "data_keranjang_layanan_open" => $keranjang_layanan_user_buka_2,
            "data_keranjang_close" => $keranjang_layanan_user_tutup_2
        ]);
    }

    public function keranjang_layanan_hapus_aktif(Request $request)
    {
        keranjang_layanan::where('id', $request->id_keranjang_layanan)->delete();

        return response()->json([
            'message' => 'success',
            'message 2' => 'Berhasil menghapus Keranjang Layanan'
        ]);
    }

    public function keranjang_layanan_hapus_non_aktif(Request $request)
    {
        $user = auth()->user();

        keranjang_layanan::where('user_id', $user->id)->where('status', false)->delete();

        return response()->json([
            'message' => 'success',
            'message 2' => 'Berhasil menghapus semua keranjang layanan yang tidak aktif user'
        ]);
    }
}
