<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::paginate(10); // Atau gunakan metode lainnya
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
{
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|email|unique:users,email',
    //     'password' => 'required|string|min:8|confirmed',
    //     'role' => 'required|in:admin,superadmin,customer', // Sesuaikan dengan daftar role
    //     'balance' => 'required|numeric|min:0', // Validasi balance
    // ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'balance' => $request->balance,
        'email_verified_at' => now(),
    ]);

    return redirect()->back()->with('success', 'User berhasil ditambahkan.');
}


    // Menampilkan form untuk mengedit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Mengupdate user
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => "required|email|unique:users,email,{$user->id}",
        'password' => 'nullable|string|min:8|confirmed',
        'role' => 'required|in:admin,superadmin,customer',
        'balance' => 'required|numeric|min:0',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'role' => $request->role,
        'balance' => $request->balance,
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
}


    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
