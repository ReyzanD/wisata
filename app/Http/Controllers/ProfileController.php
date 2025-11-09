<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show(){
        return view('profile.show',[
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request){
        $user = auth()->user();

        $request->validate([
            'name_232136' => 'required|string|max:255',
            'email_232136' => 'required|email|unique:users_232136,email_232136,' . $user->id,
            'current_password' => 'nullable|current_password',
            'password_232136' => 'nullable|confirmed|min:8',
        ]);

        $user->name_232136 = $request->name_232136;
        $user->email_232136 = $request->email_232136;

        if ($request->filled('password_232136')){
            if (!$request->filled('current_password')){
                return back()->withErrors(['current_password' => 'Password saat ini harus diisi untuk mengubah password']);
            }
            $user->password_232136 = Hash::make($request->password_232136);
        }
        $user->save();
        return back()->with('success','Profil berhasil diperbarui');
    }
}