<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'id_sekolah' => 'required|unique:users|regex:/^\d{9}$/',
            'nama'       => 'required',
            'kelas'      => 'required',
            'jurusan'    => 'required',
            'username'   => 'required|unique:users|min:8',
            'password'   => 'required|min:8|confirmed',
        ]);

        // Format otomatis
        $validated['email'] = $validated['id_sekolah'] . '@student.smktelkom-jkt.sch.id';
        $validated['nama'] = strtoupper($validated['nama']);
        $validated['kelas'] = strtoupper($validated['kelas']);
        $validated['jurusan'] = strtoupper($validated['jurusan']);
        $validated['username'] = strtolower($validated['username']);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';

        User::create($validated);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('books.index');
        }

        return back()->withErrors([
            'message' => 'Username atau password salah.',
        ]);
    }

    public function showlogin()
    {
        return view('auth.login');
    }

    public function showregister()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout.');
    }
}
