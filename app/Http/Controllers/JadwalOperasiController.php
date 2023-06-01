<?php

namespace App\Http\Controllers;

use App\Models\jadwal_operasi;
use App\Models\kategori_operasi;
use App\Models\skema_operasi;
use App\Models\operasi;
use Illuminate\Http\Request;

class JadwalOperasiController extends Controller
{
    public function index()
    {
            return view('jadwal_operasi.index',[
            'title' => 'Jadwal Operasi',
            'kategori_operasi_all' => kategori_operasi::latest()->get(),
            'jadwal_operasi_all' => jadwal_operasi::orderBy('tanggal','asc')->get()
            ]);
    }


    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date|unique:jadwal_operasi',
            'kategori_operasi_id' => 'required|max:3|min:1',
        ]);
        $validatedData['status'] = 0;

        //0.1 membandingkan membandingkan jika seharusnya jadwal operasi dibuat sekiranya satu hari sebelum 
        $tanggal_hari_ini = date('Y-m-d');;
        $tanggal_operasi_dibuat = date($validatedData['tanggal']);

        // cek apakah tanggal pembuatan menggunakan waktu lampau
        if($tanggal_hari_ini > $tanggal_operasi_dibuat){
            return redirect('/jadwal_operasi')->with('fail','Tidak boleh membuat jadwal operasi dengan waktu lampau');
        } 

        // cek apakah hari pembuatan 1 hari ++ hari yang lalu
        $tanggal_operasi_dibuat_cek = date('Y-m-d', strtotime("-2 day", strtotime($tanggal_operasi_dibuat)));
        if($tanggal_hari_ini > $tanggal_operasi_dibuat_cek ){
            return redirect('/jadwal_operasi')->with('fail','Tidak boleh membuat jadwal operasi kurang dari 2 hari dari jadwal operasi baru');
        } 
        
        // 1 cek apalakah data kategori_operasi ada 
        if(kategori_operasi::where('id',$request->kategori_operasi_id)->get()->isEmpty()){
            return redirect('/jadwal_operasi')->with('fail','Kategori Operasi Tidak tersedia');
        }

        
        // 2.1 cek apakah skema pada kategori operasi yang digunakan ada skema
        if(skema_operasi::where('kategori_operasi_id',$request->kategori_operasi_id)->get()->isEmpty()){
            return redirect('/jadwal_operasi')->with('fail','Skema operasi pada kategori operasi yang dipilih tidak valid, silahkan pilih skema lain');
        }


        // 2.3 input jadwal operasi
        $nama_kategori_operasi = kategori_operasi::where('id',$validatedData['kategori_operasi_id'])->first()->nama;
            
        jadwal_operasi::create([
            'tanggal' => $validatedData['tanggal'],
            'kategori_operasi' => $nama_kategori_operasi,
            'hari' => date('d', strtotime($validatedData['tanggal'])),
            'bulan' => date('m', strtotime($validatedData['tanggal'])),
            'tahun' => date('Y', strtotime($validatedData['tanggal'])),
            'status' => $validatedData['status']
        ]);

        // // 2.2 mendapatkan data skema operasi dari kyg operasi yang dipilih 
        $data_skema_operasi_all = skema_operasi::where('kategori_operasi_id',$request->kategori_operasi_id)->get();
        $data_jadwal_operasi_baru = jadwal_operasi::where('tanggal',$validatedData['tanggal'])->first();
        $data_jadwal_operasi_baru_id =  $data_jadwal_operasi_baru->id;
        
        // // 2.3 memasukkan kedalam table operasi
        foreach($data_skema_operasi_all as $sko){
            operasi::create([
                'jadwal_operasi_id' => $data_jadwal_operasi_baru_id,
                'waktu_mulai' => $sko->waktu_mulai,
                'waktu_selesai' => $sko->waktu_selesai,
                'status'=> 'kosong' 
            ]);
        }

        return redirect('/jadwal_operasi')->with('success','suskes menambahkan data operasi');
    }

    public function updateStatus(jadwal_operasi $jadwal_operasi){

        if($jadwal_operasi->status == true){
            $jadwal_operasi->status = false;
            $jadwal_operasi->save();
        }else if($jadwal_operasi->status == false){
            $jadwal_operasi->status = true;
            $jadwal_operasi->save();
        }
        return redirect('/jadwal_operasi')->with('success','Status jadwal operasi berhasil diubah');
    }

    public function hapusJadwal(jadwal_operasi $jadwal_operasi){
        return [
            "message" => 'fitur hapus pada jadwal operasi masih dalam pengerjaan',
            "data" => $jadwal_operasi
        ];
    }
}