<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // cek apakah ada user dengan email yang sama
        if (User::where('email', $request->input('email'))->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email yang kamu masukkan sudah terdaftar. Silakan gunakan email lain..']);
        }

        // cek apakah password dan password confirmation sama
        if ($request->input('password') !== $request->input('password_confirmation')) {
            return redirect()->back()->withErrors(['password' => 'Password dan konfirmasi password tidak sama. Silakan coba lagi...']);
        }

        $encodedPassword = bcrypt($request->input('password'));

        // Buat user baru
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'admin',
            'password' => $encodedPassword,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // cek apakah ada user dengan email dan password yang sesuai
        if (!User::where('email', $credentials['email'])->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar. Silakan coba lagi.']);
        }

        // cek apakah password yang dimasukkan benar
        if (!auth()->validate($credentials)) {
            return redirect()->back()->withErrors(['password' => 'Password salah. Silakan coba lagi.']);
        }

        // cek apakah user berhasil login
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.requests.index')->with('success', 'Selamat datang, Admin!');
            }
            return redirect()->route('researchrequest.user', ['userId' => $user->id])->with('success', 'Selamat datang, Mahasiswa!');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah. Silakan coba lagi.']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
