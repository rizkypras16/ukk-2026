<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Alat;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\User;

class AspirasiController extends Controller
{
    // Cek apakah pengguna yang sedang login adalah admin
    private function isAdmin(): bool
    {
        $currentUser = User::current();

        return $currentUser && strtolower($currentUser->role) === 'admin';
    }

    // TAMPILKAN DAFTAR PENGADUAN / ASPIRASI
    public function index(Request $request)
    {
        $data = Aspirasi::with('kategori')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('aspirasi.index', compact('data'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('aspirasi.create', compact('kategori'));
    }

    // SIMPAN DATA + UPLOAD FOTO
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|numeric',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $namaFoto = null;

        // Proses Upload File Foto Bukti
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];
            $namaFoto = time() . '_' . basename($file['name']);

            $targetDir = function_exists('public_path') ? \public_path('uploads/aspirasi/') : __DIR__ . '/../../public/uploads/aspirasi/';

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            move_uploaded_file($file['tmp_name'], $targetDir . $namaFoto);
        }

        Aspirasi::create([
            'user_id'     => 1, // Sesuaikan dengan user yang sedang login jika ada
            'id_kategori' => $request->id_kategori,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $namaFoto,
            'status'      => 'Pending',
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    // FORM EDIT: satu view (aspirasi.edit) dipakai admin (tanggapi) dan siswa (ubah laporan)
    public function edit($id)
    {
        $aspirasi = Aspirasi::where('id', $id)->first();
        $isAdmin  = $this->isAdmin();

        if (!$aspirasi) {
            $tujuan = $isAdmin ? 'admin.aspirasi.index' : 'aspirasi.index';

            return redirect()->route($tujuan)->with('error', 'Data aspirasi tidak ditemukan.');
        }

        $kategori = Kategori::all();
        $alat     = ($isAdmin && $aspirasi->id_alat) ? Alat::where('id_alat', $aspirasi->id_alat)->first() : null;

        return view('aspirasi.edit', compact('aspirasi', 'kategori', 'alat', 'isAdmin'));
    }

    // UPDATE DATA + GANTI FOTO (+ status & tanggapan khusus admin)
    public function update(Request $request, $id)
    {
        // Admin hanya mengubah status dan tanggapan
        if ($this->isAdmin()) {
            $request->validate([
                'status' => 'required|string',
            ]);

            $aspirasi = Aspirasi::where('id', $id)->first();

            if ($aspirasi) {
                $aspirasi->update([
                    'status'    => strtolower($request->input('status')),
                    'tanggapan' => $request->input('tanggapan'),
                ]);
            }

            return redirect()->route('admin.aspirasi.index')->with('success', 'Tanggapan berhasil disimpan.');
        }

        $request->validate([
            'id_kategori' => 'required|numeric',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aspirasi = Aspirasi::where('id', $id)->first();
        $namaFoto = $aspirasi->foto;

        $targetDir = function_exists('public_path') ? \public_path('uploads/aspirasi/') : __DIR__ . '/../../public/uploads/aspirasi/';

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            if ($aspirasi->foto && file_exists($targetDir . $aspirasi->foto)) {
                unlink($targetDir . $aspirasi->foto);
            }

            $file = $_FILES['foto'];
            $namaFoto = time() . '_' . basename($file['name']);

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            move_uploaded_file($file['tmp_name'], $targetDir . $namaFoto);
        }

        $aspirasi->update([
            'id_kategori' => $request->id_kategori,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $namaFoto,
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diperbarui');
    }

    // HAPUS DATA & FILE FOTO
    public function destroy(Request $request, $id)
    {
        $aspirasi = Aspirasi::where('id', $id)->first();
        $targetDir = function_exists('public_path') ? \public_path('uploads/aspirasi/') : __DIR__ . '/../../public/uploads/aspirasi/';

        if ($aspirasi) {
            if ($aspirasi->foto && file_exists($targetDir . $aspirasi->foto)) {
                unlink($targetDir . $aspirasi->foto);
            }
            $aspirasi->delete();
        }

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus');
    }

    // TANGGAPAN ADMIN (versi cepat tanpa form edit)
    public function tanggapi(Request $request, $id)
    {
        $aspirasi = Aspirasi::where('id', $id)->first();

        if ($aspirasi) {
            $aspirasi->tanggapan = $request->tanggapan;
            $aspirasi->status = 'selesai';
            $aspirasi->save();

            return redirect('/aspirasi')->with('success', 'Tanggapan berhasil dikirim.');
        }

        return redirect('/aspirasi')->with('error', 'Data aspirasi tidak ditemukan.');
    }

    // KHUSUS HALAMAN ADMIN
    public function adminIndex()
    {
        $data = Aspirasi::with('kategori')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('aspirasi.index', compact('data'));
    }
}