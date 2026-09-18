<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Pastikan hanya admin yang bisa akses
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // Menampilkan semua user
    public function index()
    {
        $users = User::all(); // bisa diganti paginate(10)
        return view('admin.users.index', compact('users'));
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:warga,admin',
            'nik' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user->update($request->only('name', 'email', 'role', 'nik', 'alamat'));

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
