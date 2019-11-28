<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function login($request)
    {
        $credentials = $request->all();

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'user' => auth()->user(),
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Đăng xuất thành công']);
    }

    public function info()
    {
        return response()->json(auth()->user());
    }
    
    public function changePassword($request)
    {
        $user = auth()->user();
        $oldPass = $request->get('old_password');
        if (auth()->attempt([
            'email' => $user->email,
            'password' => $oldPass
        ])) {
            $user->password = Hash::make($request->get('password'));
            $user->save();
            return response()->json(['message' => 'Đổi mật khẩu thành công']);
        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 401); 
    }



}



?>