<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login Admin RCSM',
        ]);
    }

    public function autentikasi(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data_user = User::where('email',$request->email)->first();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
            // return Auth::user();
        }      

        return back()->with('loginError','Login Error');
        // return Auth::user();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}