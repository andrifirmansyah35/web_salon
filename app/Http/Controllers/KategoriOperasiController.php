<?php

namespace App\Http\Controllers;

use App\Models\kategori_operasi;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class KategoriOperasiController extends Controller
{

    // public function checkSlug(request $request){
    //     $slug = SlugService::createSlug(kategori_operasi::class, 'slug', $request->nama);
    //     return response()->json(['slug' => $slug]);
    // }

    public function index(){
        return view('kategori_operasi.index',[
            'title' => 'Kategori operasi',
            'kategori_operasi' => kategori_operasi::orderBy('created_at', 'desc')->get()
        ]);
    }


    
    public function create()
    {
        return view('kategori_operasi.create',[
            'title'=>'Tambah Data Kategori Operasi'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:30|unique:kategori_operasi',
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(kategori_operasi::class, 'slug', $request->nama);

        kategori_operasi::create($validatedData);
        return redirect('/kategori_operasi')->with('success','New Kategori Operation has been added');
    }


    public function show(kategori_operasi $kategori_operasi)
    {
        return view('kategori_operasi.show',[
            'title' => 'Skema Operasi : '.$kategori_operasi->nama,
            'kategori_operasi' => $kategori_operasi      
        ]
    );
    }


    public function edit(kategori_operasi $kategori_operasi)
    {
        return view('kategori_operasi.edit',[
            'title' => 'Edit kategori Layanan',
            'kategori_operasi' => $kategori_operasi,
        ]);
    }

    public function update(Request $request, kategori_operasi $kategori_operasi)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:30|unique:kategori_operasi',
        ]);

        $validatedData['slug'] = SlugService::createSlug(kategori_operasi::class, 'slug', $request->nama);

        kategori_operasi::where('slug',$kategori_operasi->slug)
        ->update($validatedData);
        
        return redirect('/kategori_operasi')->with('success','Kategori Operasi berhsil diupdate!');
    }

    public function destroy(kategori_operasi $kategori_operasi)
    {
        return "itur in masih dalam pengerjaan";
    }
}