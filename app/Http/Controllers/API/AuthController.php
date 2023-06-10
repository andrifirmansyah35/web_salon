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
        $user = User::where('email', $request->email)->first();

        if ($request->password_baru && $user != []) {
            $password_baru_hash = Hash::make($request->password_baru);

            User::whereId($user->id)->update(['password' => $password_baru_hash]);

            return response()->json([
                'message' => 'Berhasil Menganti Passsword',
            ]);
        }

        return response()->json([
            'message' => 'failed',
            'message_2' => 'gagal memperbaharui password'
        ]);
    }
}
