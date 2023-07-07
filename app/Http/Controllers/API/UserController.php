<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TokenPassword;
use App\Http\Controllers\Controller;
// email -------------------------------------------
use App\Mail\TokenLupaPasswordEmail;
use Illuminate\Support\Facades\Mail;
// validasii
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
// passwort generate
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function send_token_lupa_password(Request $request)
    {
        // 1. cek apakah ada emailnya
        $user = User::where('email', $request->email)
            ->where('level', 'member')->first();

        if ($user == null) {
            return response()->json([
                'message' => 'failed',
                'info' => 'member tidak ditemukan'
            ]);
        }

        // test cek data -------------------
        // return response()->json([
        //     'dta' => $user
        // ]);

        // // 2. membuat token
        $token = strval(random_int(100000, 999999));

        // // 2.1 cek token jika sebelumnya ada maka hapus
        TokenPassword::where('user_id', $user->id)->delete();

        // // 3. memasukkan token kedalam database
        $datas = [
            'user_id' => $user->id,
            'token' => $token
        ];
        TokenPassword::create($datas);

        // // 4. mengirim email token 
        $isi_email = [
            'title' => 'RCSM Bantul - Token New Password',
            'token' => $token,
        ];

        $tujuan = $user->email;

        Mail::to($tujuan)->send(new TokenLupaPasswordEmail($isi_email));

        return response()->json([
            'message' => 'success',
            'info' => 'berhasil mengirimkan email'
        ]);
    }

    public function password_baru_dengan_token_konfirmasi(Request $request)
    {

        // $request = [email,token,password] 
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password_baru' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'error' => $validator->errors()
            ]);
        }

        // cari user ------------------------------------------------------
        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return response()->json([
                'message' => 'failed',
                'error' => 'akun email tidak tersedia'
            ]);
        }

        // cari data token -------------------------------------------------
        $cek_token_user = TokenPassword::where('user_id', $user->id)->where('token', $request->token)->first();

        if ($cek_token_user == null) {
            return response()->json([
                'message' => 'failed',
                'error' => 'token dalah'
            ]);
        }

        // mengubah password user ----------------------------------
        $password_generate = Hash::make($request->password_baru);
        User::where('email', $request->email)->update(['password' => $password_generate]);

        // menghapus data token--------------------------------
        TokenPassword::where('user_id', $user->id)->where('token', $request->token)->delete();

        return response()->json([
            'message' => 'success',
            'info' => 'password berhasil diubah'
        ]);
    }

    public function password_baru(Request $request)
    {
        // {email,password_baru}
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'error' => $validator->errors()
            ]);
        }

        // cari user ------------------------------------------------------
        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return response()->json([
                'message' => 'failed',
                'error' => 'akun email tidak tersedia'
            ]);
        }

        $password_generate = Hash::make($request->password_baru);
        User::where('email', $request->email)->update(['password' => $password_generate]);

        return response()->json([
            'message' => 'success',
            'info' => 'password berhasil diubah'
        ]);
    }
}
