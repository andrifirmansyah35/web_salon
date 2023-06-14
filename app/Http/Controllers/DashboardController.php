<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Dashboard'
        ]);
        // return [
        //     'halaman' => 'dashboard',
        //     'data user' => Auth::user()
        // ];
        // return view('index',[
        //     'title' => 'dashboard',
        //     'user_data' => Auth::user()
        // ]);
    }
}
