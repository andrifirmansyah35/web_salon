<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jadwal_operasi;
use App\Models\reservasi;
use App\Models\User;
use App\Models\layanan;
use App\Models\operasi;

use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporan_reservasi()
    {
        // A.0 fitur pengubah data lampau antri menjadi tidak datang && jika tanggal lampau tanggal akan diubah menjadi false -----------------------------------------------------------------
        $jadwal_lampau = jadwal_operasi::whereDate('tanggal', '<', date('Y-m-d'));

        // A.1 mengubah jadwal lampau bernilai false ----------------------------------------------------------------------------
        $jadwal_lampau->where('status', true)->update(['status' => false]);

        // A.2 mengubah reservasi dengan jadwal itu yang masih antri menjadi tidak datang
        $jadwal_lampau_a = jadwal_operasi::whereDate('tanggal', '<', date('Y-m-d'))->where('status', false)->get();

        foreach ($jadwal_lampau_a as $j) {
            reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'antri')->update(['status' => 'tidak datang']);
        }
        // =============================================================================================================================

        // return jadwal_operasi::whereDate('tanggal', '<', date('Y-m-d'))->get();

        // $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'antri')->get();

        // // xxx mengubah data antri ke data tidak datang------------------------------------------------------------------------
        // if ($reservasi_tanggal != []) {
        //     foreach ($reservasi_tanggal as $rt) {
        //         Reservasi::where('id', $rt->id)
        //             ->update(['status' => 'tidak datang']);
        //         $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'tidak datang')->get();
        //     }
        // }


        // 0. data awal---------------------------------------------------------------------------------------------------------
        // $jadwal_operasi = jadwal_operasi::where('status', false)->get();
        $jadwal_operasi = null;
        // 1. cari data dengan session tanggal yang sudah di non aktifkan----------------------------------------------------------------
        if (session()->has('laporan_reservasi_tanggal_awal')) {
            $waktu_awal = session()->get('laporan_reservasi_tanggal_awal');
            $waktu_akhir = session()->get('laporan_reservasi_tanggal_akhir');
            $laporan_status = session()->get('laporan_status');

            // jika waktu akhir melebihi hari sekarang ---(maka ubah waktu akhir)---------------------------------

            if ($waktu_akhir >= date('Y-m-d')) {
                $waktu_akhir = date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))));
            }

            $jadwal_operasi = jadwal_operasi::whereBetween('tanggal', [$waktu_awal, $waktu_akhir])->where('status', false)
                ->get();
        }

        if (!session()->has('laporan_reservasi_tanggal_awal')) {
            return view('laporan.laporan_reservasi', [
                'title' => 'Daftar Reservasi',
                'laporan_reservasi' => []
            ]);
        }

        // 2. cari data operasi dari data jadwal---------------------------------------------------------------------------------
        $laporan_reservasi = [];
        $daftar_jadwal_operasi = []; //nanti akan menyimpan array tanggal :: supaya perulagan reservasi tidak terlalu berat

        foreach ($jadwal_operasi as $j) {
            $daftar_jadwal_operasi[] = [
                "id" => $j->id,
                "tanggal" => $j->tanggal,
                "kategori_operasi" => $j->kategori_operasi,
                "hari" => $j->hari,
                "bulan" => $j->bulan,
                "tahun" => $j->tahun,
                "status" => $j->status
            ];

            $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->get();

            if ($laporan_status == "reservasi selesai") {   //tergantung button
                $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'selesai')->get();
            } else if ($laporan_status == "reservasi tidak datang") {
                // $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'antri')->get();

                // // xxx mengubah data antri ke data tidak datang------------------------------------------------------------------------
                // if ($reservasi_tanggal != []) {
                //     foreach ($reservasi_tanggal as $rt) {
                //         Reservasi::where('id', $rt->id)
                //             ->update(['status' => 'tidak datang']);
                //         $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'tidak datang')->get();
                //     }
                // }
                $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'tidak datang')->get();
            } else {
                $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->get();
            }


            foreach ($reservasi_tanggal as $rt) {
                $data_layanan = layanan::where('id', $rt->layanan_id)->first();
                $reservasi_jadwal_operasi = jadwal_operasi::where('id', $rt->jadwal_operasi_id)->first()->tanggal;
                $reservasi_operasi = operasi::where('id', $rt->operasi_id)->first();
                $reservasi_operasi_mulai = $reservasi_operasi->waktu_mulai;
                $reservasi_operasi_selesai = $reservasi_operasi->waktu_selesai;

                $laporan_reservasi[] = [
                    'id' => $rt->id,
                    'jadwal_operasi_tanggal' => $reservasi_jadwal_operasi . " (" . $reservasi_operasi_mulai . "-" . $reservasi_operasi_selesai . ")",
                    'user_member_nama' => user::where('id', $rt->user_id)->first()->name,
                    'layanan_nama' => $data_layanan->nama,
                    'harga' => $data_layanan->harga,
                    'status' => $rt->status
                ];
            }
        }

        return view('laporan.laporan_reservasi', [
            'title' => 'Laporan Reservasi',
            'laporan_reservasi' => $laporan_reservasi
        ]);
    }

    public function reservasi_laporan_set_waktu(Request $request)
    {
        $request->session()->put('laporan_reservasi_tanggal_awal', $request->tanggal_awal);
        $request->session()->put('laporan_reservasi_tanggal_akhir', $request->tanggal_akhir);
        $request->session()->put('laporan_status', $request->laporan_status);

        return redirect('/laporan_reservasi');
    }

    public function print_laporan_reservasi()
    {
        $jadwal_operasi = jadwal_operasi::where('status', false)
            ->get();

        if (session()->has('laporan_reservasi_tanggal_awal')) {
            $waktu_awal = session()->get('laporan_reservasi_tanggal_awal');
            $waktu_akhir = session()->get('laporan_reservasi_tanggal_akhir');
            $laporan_status = session()->get('laporan_status');

            $jadwal_operasi = jadwal_operasi::whereBetween('tanggal', [$waktu_awal, $waktu_akhir])->where('status', false)
                ->get();
        }

        if (!session()->has('laporan_reservasi_tanggal_awal')) {
            return redirect('/laporan_reservasi')->with('fail', 'Anda belum memasukkan jangka waktu informasi laporan reservasi');
        }

        // // 2. cari data operasi dari data jadwal---------------------------------------------------------------------------------
        $laporan_reservasi = [];

        $daftar_jadwal_operasi = []; //nanti akan menyimpan array tanggal :: supaya perulagan reservasi tidak terlalu berat

        foreach ($jadwal_operasi as $j) {

            $daftar_jadwal_operasi[] = [
                "id" => $j->id,
                "tanggal" => $j->tanggal,
                "kategori_operasi" => $j->kategori_operasi,
                "hari" => $j->hari,
                "bulan" => $j->bulan,
                "tahun" => $j->tahun,
                "status" => $j->status
            ];

            $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->get();


            if ($laporan_status == "reservasi selesai") {
                $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'selesai')->get();
            } else if ($laporan_status == "reservasi tidak datang") {
                $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->where('status', 'antri')->get();
            } else {
                $reservasi_tanggal = Reservasi::where('jadwal_operasi_id', $j->id)->get();
            }

            foreach ($reservasi_tanggal as $rt) {
                $data_layanan = layanan::where('id', $rt->layanan_id)->first();
                $reservasi_jadwal_operasi = jadwal_operasi::where('id', $rt->jadwal_operasi_id)->first()->tanggal;
                $reservasi_operasi = operasi::where('id', $rt->operasi_id)->first();
                $reservasi_operasi_mulai = $reservasi_operasi->waktu_mulai;
                $reservasi_operasi_selesai = $reservasi_operasi->waktu_selesai;

                $laporan_reservasi[] = [
                    'id' => $rt->id,
                    'jadwal_operasi_tanggal' => $reservasi_jadwal_operasi . " (" . $reservasi_operasi_mulai . "-" . $reservasi_operasi_selesai . ")",
                    'user_member_nama' => user::where('id', $rt->user_id)->first()->name,
                    'layanan_nama' => $data_layanan->nama,
                    'harga' => $data_layanan->harga,
                    'status' => $rt->status
                ];
            }
        }

        $pdf = PDF::loadView(
            'laporan.print_laporan_reservasi',
            compact('laporan_reservasi')
        );

        return $pdf->stream('laporan_reservasi.pdf');
    }

    public function print_daftar_layanan()
    {
        $layanan_all = layanan::all();

        $pdf = PDF::loadView(
            'laporan.print_daftar_layanan',
            compact('layanan_all')
        );
        return $pdf->stream('laporan_layanan.pdf');
    }
}
