<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_232136' => 'required|string|max:255',
            'email_232136' => 'required|email|unique:users_232136,email_232136',
            'password_232136' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name_232136' => $request->name_232136,
            'email_232136' => $request->email_232136,
            'password_232136' => Hash::make($request->password_232136),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name_232136' => 'required|string|max:255',
            'email_232136' => 'required|email|unique:users_232136,email_232136,' . $id,
            'password_232136' => 'nullable|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $data = [
            'name_232136' => $request->name_232136,
            'email_232136' => $request->email_232136,
            'role' => $request->role,
        ];

        if ($request->filled('password_232136')) {
            $data['password_232136'] = Hash::make($request->password_232136);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
