<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\layanan;
// use App\Models\kategori_layanan;

class LayananController extends Controller
{
    public function detail(Request $request)
    {
        $layanan = layanan::where('slug', $request->slug)->get();

        return response()->json([
            'message' => 'success',
            'layanan' => $layanan,
        ]);
    }

    public function rekomendasi()
    {
        $layanan_rekomendasi = layanan::all()->random(12);

        return response()->json([
            'message' => 'success',
            'layanan_all_rekomendasi' => $layanan_rekomendasi,
        ]);
    }
}
