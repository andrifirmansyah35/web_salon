<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\jadwal_operasi;
use App\Models\operasi;
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
}
