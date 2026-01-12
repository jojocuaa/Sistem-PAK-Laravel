<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function LoginForm()
    {
        return view('login');
    }
    public function Login_Admin()
    {
        return view('login_admin');
    }
    public function login(Request $request)
    {
        $userid = $request->input('userid');
        $password = $request->input('password');

        $user = DB::table('pegawai')
            ->where('username', $userid)
            ->where('password', $password) // plain-text (sesuai permintaan kamu)
            ->first();

        if (!$user) {
            return back()->withErrors(['login' => 'Userid atau password salah']);
        }

        // SIMPAN SEMUA DATA PENTING
        session([
            'username' => $user->username,
            'nama' => $user->nama,
            'nip' => $user->NIP,
            'is_admin' => false

        ]);

        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }
    public function loginAdmin(Request $request)
    {
        $userid   = $request->input('userid');
        $password = $request->input('password');

        $admin = DB::table('admins')
            ->where('username', $userid)
            ->where('password', $password) // sesuai sistem kamu (plain text)
            ->where('is_active', 1)
            ->first();

        if (!$admin) {
            return back()->withErrors(['login' => 'Username atau password admin salah']);
        }

        session([
            'admin_id' => $admin->id,
            'username' => $admin->username,
            'nama'     => $admin->name,
            'is_admin' => true,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Login admin berhasil');
    }

}
