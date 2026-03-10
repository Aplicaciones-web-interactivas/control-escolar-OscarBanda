<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'clave_institucional' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt([
            'clave_institucional' => $request->clave_institucional,
            'password' => $request->password,
            'is_active' => true
        ])) {

            $request->session()->regenerate();

            return back()->with('success', 'Login exitoso');
        }

    return back()->with('error', 'Credenciales incorrectas');
}
}