<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategori_layanan;
use App\Models\layanan;

class KategoriLayananController extends Controller
{
    public function index()
    {
        $kategori_all = kategori_layanan::all();

        $data_kategori_layanan = [];

        foreach ($kategori_all as $kategori) {
            $data_kategori_layanan[] = [
                "id" => $kategori->id,
                "nama" => $kategori->nama,
                "gambar" => $kategori->gambar,
                "slug" => $kategori->slug,
                "jumlah_layanan" =>  $kategori->layanan->count()
            ];
        }

        return response()->json([
            'message' => 'success',
            'kategori_layanan' => $data_kategori_layanan
        ]);
    }

    public function kategori_layanan_layanan_all(Request $request)
    {
        $kategori_layanan = kategori_layanan::where('slug', $request->slug_kategori)->first();

        $layanan = layanan::where('kategori_layanan_id', $kategori_layanan->id)->get();

        return response()->json([
            'message' => 'success',
            'kategori_layanan' => $kategori_layanan->nama,
            'layanan_all' => $layanan
        ]);
        // return $request;
    }
}
