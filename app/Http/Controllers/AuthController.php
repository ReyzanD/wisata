<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){
        if (Auth::check()) {
            return auth()->user()->role === 'admin' 
                ? redirect()->route('dashboard') 
                : redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Map standard field names to custom column names
        $credentials = [
            'email_232136' => $request->email,
            'password_232136' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            if (auth()->user()->role === 'admin') {
                return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil!');
            }
            
            // For regular users, always go to home (don't use intended)
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function showRegister(){
        if (Auth::check()){
            return auth()->user()->role === 'admin' 
                ? redirect()->route('dashboard') 
                : redirect()->route('home');
        }
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'name_232136' => 'required|string|max:255',
            'email_232136' => 'required|email|unique:users_232136,email_232136',
            'password_232136' => 'required|min:6|confirmed',
        ]);


        $user = User::create([
            'name_232136' => $request->name_232136,
            'email_232136' => $request->email_232136,
            'password_232136' => Hash::make($request->password_232136),
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }

}