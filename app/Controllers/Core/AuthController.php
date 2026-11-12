<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
use App\Models\Siswa;
use Sakuci\Controller;
use Sakuci\Http\Request;
use Sakuci\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('core.auth.login');
    }

    public function showRegister()
    {
        try {
            return view('core.auth.register');
        } catch (\Throwable $e) {
            return redirect('/login')->with('error', 'Pendaftaran belum siap/dibuka.');
        }
    }

    public function register(Request $request)
    {
        try {
            // 1. Ambil input NIS / Username & potong jika lebih dari 50 karakter
            $rawInput = trim($request->input('username') ?? $request->input('nis') ?? '');
            $usernameInput = substr($rawInput, 0, 20);

            if (empty($usernameInput)) {
                return back()->with('error', 'NIS / Username wajib diisi.')->withInput();
            }

            // 2. Validasi Input
            $rules = [
                'password' => 'required|min:6|confirmed',
                'nama'     => 'required|string|max:255',
                'kelas'    => 'required|string|max:50',
            ];

            $data = $request->validate($rules);

            // Cek keunikan NIS/Username di database
            $existingUser = User::firstWhere('username', $usernameInput);
            if ($existingUser) {
                return back()->with('error', 'NIS / Username sudah terdaftar. Gunakan NIS lain.')->withInput();
            }

            // 3. PAKSA ROLE MENJADI 'siswa' (Bukan admin)
            $userRole = 'siswa';

            // 4. Simpan ke tabel users
            $user = User::create([
                'username' => $usernameInput,
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role'     => $userRole,
            ]);

            // 5. Simpan ke tabel siswa
            if (class_exists(Siswa::class)) {
                Siswa::create([
                    'id_user'     => $user->id_user,
                    'id_kategori' => null,
                    'nis'         => $usernameInput,
                    'nama'        => $request->input('nama'),
                    'kelas'       => $request->input('kelas'),
                ]);
            }

            // Set session login
            Session::put('user_id', $user->id_user);

            return redirect('/dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang, ' . $user->username . '.');

        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal mendaftar: ' . $e->getMessage())->withInput();
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::firstWhere('username', $data['username']);

        if (! $user || ! password_verify($data['password'], $user->password)) {
            return back()
                ->withErrors(['username' => 'Username atau password salah.'])
                ->withInput();
        }

        Session::put('user_id', $user->id_user);

        // Pengarahan otomatis berdasarkan role
        if (strtolower($user->role) === 'admin') {
            return redirect('/admin')->with('success', 'Selamat datang kembali Admin, ' . $user->username . '.');
        }

        return redirect('/dashboard')->with('success', 'Selamat datang, ' . $user->username . '.');
    }

    public function logout()
    {
        Session::forget('user_id');

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}