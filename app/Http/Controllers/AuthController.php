<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Menangani login user.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login user
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Login berhasil sebagai Admin!');
            } elseif ($user->role === 'supervisor') {
                return redirect()->route('supervisor.index')->with('success', 'Login berhasil sebagai Supervisor!');
            }
            
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Menangani logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token untuk keamanan

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }


    /**
     * Menampilkan halaman register.
     */
    public function showRegisterForm()
    {
        return view('register');
    }

    /**
     * Menangani pendaftaran user baru.
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,supervisor', // Validasi role
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Login user secara otomatis
        Auth::login($user);

        // Redirect berdasarkan role
        return redirect()->route('admin.index')->with('success', 'Registrasi berhasil!');
    }
}

