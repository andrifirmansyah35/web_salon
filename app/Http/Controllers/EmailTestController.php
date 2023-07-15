<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;        //memangil fungsi email
use App\Mail\SendEmail;

class EmailTestController extends Controller
{
    // public function index()
    // {
    //     Mail::to('aw110874@gmail.com')->send(new SendEmail);
    //     return 'berhasil mengirim email';
    // }

    public function kedua()
    {
        $isi_email = [
            'title' => 'RCSM Bantul - Token Untuk Password Baru',
            'body' => 'Berikut token yang dapat anda gunakan untuk password baru anda'
        ];

        $tujuan = 'aw110874@gmail.com';

        Mail::to($tujuan)->send(new SendEmail($isi_email));
        return 'berhasil mengirim email';
    }
}
