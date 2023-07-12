<?php

namespace App\Http\Controllers;

use App\Models\jadwal_operasi;
use App\Models\reservasi;
use App\Models\User;
use App\Models\layanan;
use App\Models\operasi;

use Illuminate\Http\Request;
// modal reservasi

class ReservasiController extends Controller
{
    public function reservasi()
    {
        $hari_ini = date("Y-m-d");
        $jadwal_operasi = jadwal_operasi::where('tanggal', $hari_ini)->first();

        if ($jadwal_operasi == null) {
            return view('reservasi.reservasi_sekarang', [
                'title' => 'Daftar reservasi hari ini : ' . $hari_ini,
                'reservasi_all' => []
            ]);
        }

        $operasi_booking_hari_ini = operasi::where('jadwal_operasi_id', $jadwal_operasi->id)->where('status', 'dibooking')->get();
        $reservasi_hari_ini = [];

        foreach ($operasi_booking_hari_ini as $ob) {
            $reservasi = reservasi::where('operasi_id', $ob['id'])->first();

            $user_reservasi = User::where('id', $reservasi->user_id)->first();
            $layanan_reservasi = layanan::where('id', $reservasi->layanan_id)->first();
            $operasi_reservasi = operasi::where('id', $reservasi->operasi_id)->first();
            // $reservasi_hari_ini[] = reservasi::where('operasi_id', $ob['id'])->first()->toArray();

            $reservasi_hari_ini[] = [
                'id' => $reservasi->id,
                'user_id' => $reservasi->user_id,
                'user_nama' => $user_reservasi->name,
                'layanan_id' => $reservasi->layanan_id,
                'layanan_nama' => $layanan_reservasi->nama,
                'layanan_harga' => $layanan_reservasi->harga,
                'operasi_id' => $reservasi->operasi_id,
                'operasi_mulai' => $operasi_reservasi->waktu_mulai,
                'operasi_selesai' => $operasi_reservasi->waktu_selesai,
                'status' => $reservasi->status
            ];
        }

        $hari_judul = date("d M Y");
        // $nama_hari = date('I', $hari_ini);

        return view('reservasi.reservasi_sekarang', [
            'title' => 'Daftar reservasi hari ini : ' . $hari_judul,
            'reservasi_all' => $reservasi_hari_ini
        ]);
    }

    public function reservasi_status(Request $request)
    {
        // return $request->input();
        reservasi::where('id', $request->id_reservasi)->update(['status' => $request->status]);
        return redirect('/reservasi')->with('success', 'Berhasil mengubah status');
    }

    public function konfirmasi_pembayaran(Reservasi $reservasi)
    {
        $reservasi->status = 'selesai';
        $reservasi->save();

        return redirect('/reservasi')->with('success', 'Konfirmasi Berhasil');
    }

    public function reservasi_mendatang()
    {
        // 1. mencari informasi jadwal operasi yang dibuka dimasa mndatang lebih dari hari ini
        $hari_ini = date("Y-m-d");
        $jadwal_operasi = jadwal_operasi::whereDate('tanggal', '>', $hari_ini)->get();

        // 2. mendapatkan jumlah reservasi medatang
        $daftar_jadwal_operasi_mendatang = [];
        foreach ($jadwal_operasi as $j) {
            $jumlah_reservasi = Reservasi::where('jadwal_operasi_id', $j->id)->count();
            $daftar_jadwal_operasi_mendatang[] = [
                'id' => $j->id,
                'tanggal' => $j->tanggal,
                'kategori_layanan' => $j->kategori_operasi,
                'jumlah_reservasi' => $jumlah_reservasi
            ];
        }

        return view('reservasi.reservasi_mendatang', [
            'title' => 'Daftar reservasi mendatang ',
            'reservasi_all' => $daftar_jadwal_operasi_mendatang
        ]);
    }

    public function reservasi_mendatang_detail(jadwal_operasi $jadwal_operasi)
    {
        // 1. mencari operasi terkait dengan jadwal operasi
        $operasi = operasi::where('jadwal_operasi_id', $jadwal_operasi->id)->get();
        // 2. membat array operasi dan menambahkan data pelangan jika ada yg dipesan
        $jadwal_operasi_reservasi = [];
        foreach ($operasi as $p) {
            $pelangan_nama = "-";
            $layanan_nama = "-";

            // 3. mencari data user jika operasional  dibooking
            if ($p->status == true) {
                // if ($p->booking == true) {
                $reservasi = reservasi::where('jadwal_operasi_id', $jadwal_operasi->id)
                    ->where('operasi_id', $p->id)
                    ->where('status', 'antri')->first();

                if ($reservasi != []) {
                    $user = user::where('id', $reservasi->user_id)->first();
                    $pelangan_nama = $user->name;

                    $layanan = layanan::where('id', $reservasi->layanan_id)->first();
                    $layanan_nama = $layanan->nama;
                }
            }

            $jadwal_operasi_reservasi[] = [
                "waktu_mulai" => $p->waktu_mulai,
                "waktu_selesai" => $p->waktu_selesai,
                "pelangan" => $pelangan_nama,
                "layanan" => $layanan_nama,
                "status" => $p->status
            ];
        }

        return view('reservasi.reservasi_mendatang_detail', [
            'title' => 'Daftar reservasi mendatang : ' . $jadwal_operasi->tanggal,
            'reservasi_all' => $jadwal_operasi_reservasi
        ]);
    }
}
