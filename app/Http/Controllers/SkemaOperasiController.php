<?php

namespace App\Http\Controllers;

use App\Models\skema_operasi;
use App\Models\kategori_operasi;
use Illuminate\Http\Request;

class SkemaOperasiController extends Controller
{
    public function hapusSkemaOperasi(Request $request){
        // return $request;
        skema_operasi::where('id',$request->skema_operasi_id)->delete();
        return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('success','Sukses menghapus skema operasi');
    }
    
    public function tambahSkemaOperasi(Request $request){
        
        $validatedData = $request->validate([
            'kategori_operasi_id' => 'required',
            'waktu_mulai' => 'required|max:5|min:5',
            'waktu_selesai' => 'required|max:5|min:5',
        ]);

        // fungsin untuk menjumlahkan waktu
        function getTotalMinutes($string_waktu){
            $array_waktu = str_split($string_waktu);
            $waktu_jam = intval($array_waktu[0].$array_waktu[1]);
            $waktu_menit = intval($array_waktu[3].$array_waktu[4]);
            // konfersi ke menit waktu
            return ($waktu_jam * 60) + $waktu_menit;
        }
        

        $total_menit_waktu_mulai = getTotalMinutes($request->waktu_mulai);
        $total_menit_waktu_selesai = getTotalMinutes($request->waktu_selesai); 

        // cek besar waktu 
        $cek_skema_operasi_a = false;
        
        if($total_menit_waktu_mulai < $total_menit_waktu_selesai){
            $cek_skema_operasi_a = true;    
        }
        else if($total_menit_waktu_mulai == $total_menit_waktu_selesai){
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('fail','data waktu mulai tidak boleh sama dengan waktu selesai');
        }else{
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('fail','data waktu mulai tidak boleh melebihi waktu selesai');
        }
            
        // cek database skema operasi : apakah data pada skema kosong 
        if(skema_operasi::where('kategori_operasi_id',$request->kategori_operasi_id)->get()->isEmpty()){
            skema_operasi::create($validatedData);
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('success','Sukses menambahklan data skema operasi');
        }
        
        // cek data terakhir : cari data terakhir
        $data_terakhir_skema_operasi =  skema_operasi::where('kategori_operasi_id',$request->kategori_operasi_id)->latest()->first();

        $data_terakhir_waktu_mulai = $data_terakhir_skema_operasi['waktu_mulai'];
        $data_terakhir_waktu_selesai = $data_terakhir_skema_operasi['waktu_selesai'];

        // konfersi ke menit 
        $total_data_terakhir_menit_waktu_mulai = getTotalMinutes($data_terakhir_waktu_mulai);
        $total_data_terakhir_menit_waktu_selesai = getTotalMinutes($data_terakhir_waktu_selesai); 

        // membandingkan data baru dengan data terakhir
        if($total_menit_waktu_mulai < $total_data_terakhir_menit_waktu_selesai){
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('fail','Waktu baru lebih lama dari pada data waktu terakhir');
        }else{
            skema_operasi::create($validatedData);
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('success','Sukses menambahklan data skema operasi');   
        }
            

        return [
            [
                'kategori operasi id' => $request->kategori_operasi_id,
                'kategori operasi slug' => $request->kategori_operasi_slug,
            ],
            [
                'waktu mulai jam' => $request->waktu_mulai,
                'waktu mulai menit'=> $request->waktu_selesai
            ],
            // [
            //     'waktu mulai jam' => $waktu_mulai_jam,
            //     'waktu mulai menit'=> $waktu_mulai_menit
            // ],
            // [
            //     'waktu selesai jam' => $waktu_selesai_jam,
            //     'waktu selesai menit' => $waktu_selesai_menit,
            // ],
            [
                'total menit waktu mulai' => $total_menit_waktu_mulai,
                'total menit waktu selesai' => $total_menit_waktu_selesai,
            ],
            [
                'data terakhir skema operasi array' => $data_terakhir_skema_operasi
            ],
            [
                'data terakhir waktu mulai' => $data_terakhir_waktu_mulai,
                'data terakhir waktu selesai' => $data_terakhir_waktu_selesai,
            ],
            [
                'total data terakhir menit waktu mulai' => $total_data_terakhir_menit_waktu_mulai,
                'total data terakhir menit waktu selesai' => $total_data_terakhir_menit_waktu_mulai,
            ],
        ];
    }

    
}