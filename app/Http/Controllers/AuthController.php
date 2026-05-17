<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Login
    public function showLogin()
    {
        return view('pages.auth.login');
    }

    // 2. Memproses Data Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kecocokan data dengan database
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Jika sukses, lempar ke halaman Builder
            return redirect()->intended('/builder');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah, bro!',
        ])->onlyInput('email');
    }

    // 3. Menampilkan Halaman Register
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    // 4. Memproses Data Register
    public function register(Request $request)
    {
        // Validasi form register
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Masukkan user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role dari migration kita
        ]);

        // Langsung login-kan otomatis setelah daftar
        Auth::login($user);

        return redirect('/builder');
    }

    // 5. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}