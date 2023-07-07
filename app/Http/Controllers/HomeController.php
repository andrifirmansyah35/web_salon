<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori_layanan;
use App\Models\layanan;


class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'kategori_layanan_all' => kategori_layanan::all()
        ]);
    }
}
