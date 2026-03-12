<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

            return redirect('/dashboard');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function showRegister()
    {
        return view('auth.registrarse');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'clave_institucional' => 'required|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'nombre' => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => true
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente');
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
