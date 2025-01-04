<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        // Ambil cookie email terakhir jika ada
        $lastEmail = Cookie::get('last_email'); // Pastikan cookie terbaca
        return view('auth.login', compact('lastEmail')); // Pass email terakhir ke view
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses login dan pengecekan Remember Me
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();

            // Hapus cache sebelumnya yang mungkin terkait dengan user sebelumnya
            Cache::forget('user_' . Auth::id());

            // Menyimpan ID user ke dalam session untuk memastikan session baru
            session()->put('user_id', Auth::id());

            // Jika "Remember me" dicentang, simpan email ke cookie
            if ($request->filled('remember')) {
                $minutes = 43200; // 30 hari
                Cookie::queue('last_email', $request->email, $minutes); // Simpan email ke cookie
            }

            // Redirect ke halaman yang dimaksud setelah login
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau Password tidak terdaftar dalam Sinvent SIJA.',
        ]);
    }

    // Menangani proses logout
    public function logout(Request $request)
    {
        // Hapus cache user yang sedang logout
        Cache::forget('user_' . Auth::id());

        // Logout user
        Auth::logout();

        // Hapus cookie yang berisi email terakhir
        Cookie::queue(Cookie::forget('last_email')); // Hapus cookie saat logout

        // Menghapus session
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        // Pastikan tidak ada data user yang tertinggal di session
        session()->forget('user_id');

        // Redirect ke halaman login
        return redirect('/login');
    }
}
