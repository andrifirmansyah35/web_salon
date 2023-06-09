<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    // 0. user --------------------------------------------------------------------------------------
    public function userInfo()
    {
        return view('user.user_info', [
            'title' => 'Admin Profile',
            'user' => Auth::user()
        ]);
    }

    public function userEdit()
    {
        return view('user.user_edit', [
            'title' => 'Edit Profil',
            'user' => Auth::user()
        ]);
    }

    public function userUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|max:30|min:5',
            'photo_profile' => 'image|file|mimes:jpg,png,jpeg|max:5000',
            'telephone' => 'required|numeric|min:11|unique:user',
            'alamat' => 'required|min:10|max:200',
        ];

        if ($request['password']) {
            $rules['password'] = 'min:8|max:50';
        }


        if ($request->telephone == Auth::user()->telephone) {
            $rules['telephone'] = 'required|numeric|min:11';
        }

        $validatedData = $request->validate($rules);

        if ($request['password']) {
            $validatedData['password'] =  Hash::make($validatedData['password']);
        }


        if ($request->file('photo_profile')) {
            if ($request->photoProfilLama) {
                Storage::delete($request->photoProfilLama);
            }
            $validatedData['photo_profile'] = $request->file('photo_profile')->store('user');
        }

        user::where('email', Auth::user()->email)
            ->update($validatedData);

        return redirect('/profile')->with('success', 'Profile Berhasil di update!');
    }

    // 1. pelanggan ----------------------------------------------------------------------------------
    public function inputPelanggan()
    {
        return "ini adalah fitur input pelanggan";
    }

    public function pelangan()
    {
        $data_pelanggan = User::where('level', 'pelanggan')->get();

        return view('user.pelanggan', [
            'title' => 'Daftar Pelanggan',
            'pelangan_all' => $data_pelanggan
        ]);
    }

    public function pelangganTambah()
    {
        return view('user.pelanggan_tambah', [
            'title' => 'Form Pelangan',
        ]);
    }

    public function pelanganSimpan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100|min:5|string',
            'email' => 'required|unique:user|email',
            'telephone' => 'required|numeric|min:11|unique:user',
            'alamat' => 'required|min:10|max:200',
        ]);

        $validatedData['level'] = 'pelanggan';

        User::create($validatedData);
        return redirect('/daftar_pelanggan')->with('success', 'Berhasil ' . $validatedData['name'] . ' menambahkan pelangan baru ');
    }

    public function pelanganInfo(User $user)
    {
        return view('user.pelanggan_info', [
            'title' => 'Informasi Pelanggan',
            'pelanggan' => $user
        ]);
    }

    public function pelanganjadiMember(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:40',
        ]);

        $data_pelanggan = User::where('email', $validatedData['email'])->first();

        if (User::where('email', $validatedData['email'])->get()->isEmpty()) {
            return redirect('/daftar_pelangan')->with('fail', 'Data Pelanggan tidak ditemukan');
        }

        $data_pelanggan->level = 'member';
        $data_pelanggan->password = Hash::make($validatedData['password']);
        $data_pelanggan->save();

        return redirect('/daftar_member')->with('success', $data_pelanggan->name . ' Berhasil mejadi member');
    }

    // 2. member -----------------------------------------------------------------------------------------
    public function member()
    {
        $data_member = User::where('level', 'member')->get();
        return view('user.member', [
            'title' => 'Daftar Member',
            'member_all' => $data_member
        ]);
    }

    public function memberInfo(User $user)
    {
        return view('user.member_info', [
            'title' => 'Informasi Member',
            'member' => $user
        ]);
    }


    // 3. Admin ------------------------------------------------------------------------------------------
    public function admin()
    {
        $data_admin = User::where('level', 'admin_off')->orWhere('level', 'admin')->get();
        return view('user.admin', [
            'title' => 'Daftar Admin',
            'admin_all' => $data_admin
        ]);
    }

    public function adminTambah()
    {
        return view('user.admin_tambah', [
            'title' => 'Form Admin',
        ]);
    }

    public function adminSimpan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100|min:5|string',
            'email' => 'required|unique:user|email',
            'password' => 'required|min:8|max:20',
            'telephone' => 'required|numeric|min:11|unique:user',
            'alamat' => 'required|min:10|max:200',
        ]);

        $validatedData['level'] = 'admin';

        User::create($validatedData);
        return redirect('/daftar_admin')->with('success', 'Berhasil menambahkan ' . $validatedData['name'] . ' sebagai admin');
    }

    public function adminInfo(User $user)
    {
        return view('user.admin_info', [
            'title' => 'Informasi Admin',
            'admin' => $user
        ]);
    }

    public function adminStatus(User $user)
    {

        if ($user->level == 'admin') {
            $user->level = 'admin_off';
            $user->save();

            return redirect('/daftar_admin')->with('success', 'Berhasil menonaktifkan admin ' . $user->name);
        } else if ($user->level == 'admin_off') {
            $user->level = 'admin';
            $user->save();

            return redirect('/daftar_admin')->with('success', 'Berhasil mengaktifkan admin ' . $user->name);
        }
    }
}