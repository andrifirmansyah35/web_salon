<?php

namespace App\Http\Controllers;

use App\Models\operasi;
use App\Models\jadwal_operasi;
use Illuminate\Http\Request;

class OperasiController extends Controller
{
   public function detail(jadwal_operasi $jadwal_operasi){
      $data_operasi = operasi::where('jadwal_operasi_id',$jadwal_operasi->id)->get();

      return view('operasi.index',[
      'title' => 'Detail Operasi : '.$jadwal_operasi->tanggal,
      'operasi_all' => operasi::where('jadwal_operasi_id',$jadwal_operasi->id)->get()
      ]);
   }
}