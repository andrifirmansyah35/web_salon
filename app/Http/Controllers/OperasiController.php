<?php

namespace App\Http\Controllers;

use App\Models\operasi;
use App\Models\jadwal_operasi;
use App\Models\reservasi;
use App\Models\User;
use App\Models\layanan;
use Illuminate\Http\Request;

class OperasiController extends Controller
{
   // public function detail(jadwal_operasi $jadwal_operasi)
   // {
   //    $data_operasi = operasi::where('jadwal_operasi_id', $jadwal_operasi->id)->get();

   //    return view('operasi.index', [
   //       'title' => 'Detail Operasi : ' . $jadwal_operasi->tanggal,
   //       'operasi_all' => operasi::where('jadwal_operasi_id', $jadwal_operasi->id)->get()
   //    ]);
   // }

   public function detail(jadwal_operasi $jadwal_operasi)
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
            $reservasi = reservasi::where('jadwal_operasi_id', $jadwal_operasi->id)
               ->where('operasi_id', $p->id)
               ->where('status', 'selesai')->first();

            if ($reservasi == []) {
               $reservasi = reservasi::where('jadwal_operasi_id', $jadwal_operasi->id)
                  ->where('operasi_id', $p->id)
                  ->where('status', 'antri')->first();
            }

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

      // return $jadwal_operasi_reservasi;

      return view('reservasi.reservasi_mendatang_detail', [
         'title' => 'Detail Operasinal : ' . $jadwal_operasi->tanggal,
         'reservasi_all' => $jadwal_operasi_reservasi
      ]);
   }
}
