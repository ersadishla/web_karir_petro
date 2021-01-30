<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $user = Pengguna::where('username', $request->username)->first();

        if($user == null) {
            throw ValidationException::withMessages([
                'username' => 'Username tidak ditemukan'
            ]);
        }
        if(!(Hash::check($request->password, $user->password))) {
            throw ValidationException::withMessages([
                'password' => 'Password tidak sesuai'
            ]);
        }
        if($user && (Hash::check($request->password, $user->password))) {
            Auth::login($user);

            return redirect()->route('beranda');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
    //
}
