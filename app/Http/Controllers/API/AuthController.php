<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'UNAUTHORIZEDD'
            ], 401);
        }

        if ($user->level != 'member') {
            return response()->json([
                'message' => 'akun tidak dapat digunakan pada aplikasi mobile'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil Logout',
            'nama' => $user->name
        ]);
    }

    public function password_baru(Request $request)
    {
        $user = auth()->user();

        if ($user && $request->password_baru) {
            if (Hash::check($request->password_lama, $user->password)) {

                $password_baru_hash = Hash::make($request->password_baru);

                $ubahPassword = User::whereId($user->id)->update(['password' => $password_baru_hash]);

                if ($ubahPassword) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Berhasil Menganti Passsword',
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Password lama tidak valid',
                ], 400);
            }
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'gagal memperbaharui password'
        ], 400);
    }
}
