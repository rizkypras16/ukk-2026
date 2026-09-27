<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Siswa;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $data = Siswa::leftJoin('users', 'siswa.id_user', '=', 'users.id')
            ->orderBy('siswa.id_siswa', 'desc')
            ->paginate(5);

        return view('pengguna.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis',
            'kelas' => 'required|string|max:10',
        ]);

        // Buat username dari NIS atau hilangkan spasi pada nama
        $username = strtolower(str_replace(' ', '', $request->nama));

        $user = User::create([
            'username' => $username,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'role'     => 'siswa',
        ]);

        Siswa::create([
            'nama'    => $request->nama,
            'nis'     => $request->nis,
            'kelas'   => $request->kelas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($pengguna)
    {
        $siswa = Siswa::where('id_siswa', $pengguna)->first();

        return view('pengguna.edit', compact('siswa'));
    }

    public function update(Request $request, $pengguna)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis,' . $pengguna . ',id_siswa',
            'kelas' => 'required|string|max:10',
        ]);

        $siswa = Siswa::where('id_siswa', $pengguna)->first();

        if ($siswa) {
            $siswa->update([
                'nama'  => $request->nama,
                'nis'   => $request->nis,
                'kelas' => $request->kelas,
            ]);
        }

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {
        // Cari data siswa terlebih dahulu berdasarkan id_siswa
        $siswa = Siswa::where('id_siswa', $id)->first();

        if ($siswa) {
            // Hapus akun user yang terhubung (jika ada)
            if ($siswa->id_user) {
                $user = User::find($siswa->id_user);
                if ($user) {
                    $user->delete();
                }
            }

            // Hapus data siswa
            $siswa->delete();
        }

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}