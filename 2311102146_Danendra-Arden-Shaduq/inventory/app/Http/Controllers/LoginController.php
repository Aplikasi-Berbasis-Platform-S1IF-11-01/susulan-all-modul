<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    
    // 1. Fungsi untuk menampilkan halaman form login
    public function showLogin() { 
        return view('auth.login'); 
    }
    
    // 2. Fungsi untuk memproses data saat tombol login ditekan
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Email/Password salah']);
    }

    // 3. MASUKKAN DI SINI: Fungsi untuk memproses logout
    public function logout(Request $request) {
        Auth::logout(); // Menghapus status login
        
        $request->session()->invalidate(); // Menghapus session agar aman
        $request->session()->regenerateToken(); // Mencegah serangan keamanan (CSRF)
        
        return redirect('/login'); // Mengarahkan kembali ke halaman login
    }

}