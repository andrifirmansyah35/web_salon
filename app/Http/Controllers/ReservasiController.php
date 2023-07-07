<?php

namespace App\Http\Controllers;

use App\Models\jadwal_operasi;
use App\Models\Reservasi;
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
        // mencari id jadwal_operasi
        $jadwal_operasi = jadwal_operasi::where('tanggal', $hari_ini)->first();

        if ($jadwal_operasi == null) {  //perlu diperbaiki---------------------------------------------------
            return view('reservasi.reservasi_sekarang', [
                'title' => 'Daftar reservasi hari ini : ' . $hari_ini,
                'reservasi_all' => ''
            ]);
        }

        $operasi_booking_hari_ini = operasi::where('jadwal_operasi_id', $jadwal_operasi->id)->where('status', 'dibooking')->get();

        // return $operasi_booking_hari_ini;


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

    public function reservasi_mendatang()   //progressxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxzzzzzzzzzzzzzzzzzzzzzzzzzzzzz
    {
        $hari_ini = date("Y-m-d");
        $jadwal_operasi = jadwal_operasi::where('tanggal', $hari_ini)->first();

        if ($jadwal_operasi == null) {  //perlu diperbaiki---------------------------------------------------
            return view('reservasi.reservasi_sekarang', [
                'title' => 'Daftar reservasi hari ini : ' . $hari_ini,
                'reservasi_all' => ''
            ]);
        }

        $operasi_booking_hari_ini = operasi::where('jadwal_operasi_id', $jadwal_operasi->id)->where('status', 'dibooking')->get();

        // return $operasi_booking_hari_ini;


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
}
