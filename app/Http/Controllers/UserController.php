<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('User.index', compact('users'));
    }

    public function create()
    {
        return view('User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sekolah' => 'required|unique:users',
            'jurusan'    => 'required',
            'kelas'      => 'required',
            'username'   => 'required|unique:users|min:8',
            'nama'       => 'required|string',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:6',
            'role'       => 'required|in:user,admin',
        ]);

        User::create([
            'id_sekolah' => $request->id_sekolah,
            'jurusan'    => strtoupper($request->jurusan),
            'kelas'      => strtoupper($request->kelas),
            'username'   => strtolower($request->username),
            'nama'       => strtoupper($request->nama),
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('User.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username'   => 'required|string|max:255|unique:users,username,' . $user->id,
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'id_sekolah' => 'nullable|string|max:50',
            'jurusan'    => 'nullable|string|max:100',
            'kelas'      => 'nullable|string|max:50',
            'role'       => 'required|in:user,admin',
            'password'   => 'nullable|string|min:6',
        ]);

        // Format otomatis
        $validated['nama'] = strtoupper($validated['nama']);
        $validated['username'] = strtolower($validated['username']);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        // Tidak bisa hapus diri sendiri
        if ($user->id == Auth::id()) {
            abort(403, 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
