<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\layanan;
use App\Models\kategori_layanan;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class LayananController extends Controller
{

    public function index()
    {
            // return layanan::all();
            return view('layanan.index',[
                'title' => 'Layanan',
                'layanan' => layanan::all()
            ]);
        
    }


    public function create()
    {
        return view('layanan.create',[
        'title'=>'Tambah Data Layanan',
        'kategori_layanan_all' => kategori_layanan::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_layanan_id' => 'required',
            'nama' => 'required|max:30|min:5',
            'slug' => 'required|unique:layanan',
            'harga' => 'required',
            'deskripsi' => 'required|min:10|max:200',
        ]);

        $validatedData['status'] = true;
        layanan::create($validatedData);

        return redirect('/layanan')->with('success','Berhasil menambahkan data layanan baru');
    }

    public function show(layanan $layanan)
    {
        return view('layanan.show',[
            'title'=> 'Detail data',
            'layanan'=> $layanan
            ]);
    }


    public function edit(layanan $layanan)
    {
        return view('layanan.edit',[
            'title'=> 'Edit Layanan', 
            'layanan' => $layanan,
            'kategori_layanan_all' => kategori_layanan::all()
        ]);
    }

    public function update(Request $request, layanan $layanan)
    {
        $rules = [
            'kategori_layanan_id' => 'required',
            'nama' => 'required|max:30|min:5',
            'harga' => 'required',
            'deskripsi' => 'required|min:10|max:200',
        ];

        if($request->slug != $layanan->slug){
            $rules['slug'] = 'required|unique:layanan';
        }

        $validatedData = $request->validate($rules);

        layanan::where('slug',$layanan->slug)
        ->update($validatedData);
        
        return redirect('/layanan')->with('success','Kategori layanan berhsil diupdate!');
    }

    public function destroy(layanan $layanan)
    {
        return redirect('/layanan')->with('success','Untuk Menghapus belum dapat dijalankan karena masih dalam pembangunan');
        // $nama_layanan = $layanan->nama;
        // layanan::destroy($layanan->id);
        // return redirect('/layanan')->with('success','layanan has'.$layanan->nama.' been delete'); 
    }


    public function updateStatus(layanan $layanan){
        if($layanan->status == true){
            $layanan->status = false;
            $layanan->save();
        }else if($layanan->status == false){
            $layanan->status = true;
            $layanan->save();
        }
        return redirect('/layanan/' . $layanan->slug);
    }

    public function updateStatus2(layanan $layanan){
        if($layanan->status == true){
            $layanan->status = false;
            $layanan->save();
        }else if($layanan->status == false){
            $layanan->status = true;
            $layanan->save();
        }
        return redirect('/layanan');
    }
}