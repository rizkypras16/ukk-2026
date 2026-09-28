<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengaduan;
use App\Models\Alat;
use App\Models\User;

class PengaduanController extends Controller
{
    // Menampilkan riwayat pengaduan (untuk Siswa)
    public function index(Request $request)
    {
        $currentUser = User::current();
        $userRole = strtolower($currentUser->role ?? '');

        if ($userRole === 'siswa') {
            $pengaduan = Pengaduan::where('user_id', $currentUser->id)->get();
        } else {
            $pengaduan = Pengaduan::all();
        }

        return view('pengaduan.index', compact('pengaduan'));
    }

    // Menampilkan form tambah pengaduan (untuk Siswa)
    public function create(Request $request)
    {
        $alat = Alat::all(); 
        return view('pengaduan.create', compact('alat'));
    }

    // Menyimpan pengaduan baru (untuk Siswa)
    public function store(Request $request)
    {
        $request->validate([
            'id_alat'         => 'required',
            'rincian_laporan' => 'required|string',
            'foto'            => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $currentUser = User::current();
        $fotoName = null;
        
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fotoName = time() . '_' . uniqid() . '.' . $ext;
            
            $uploadDir = public_path('uploads/pengaduan');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $fotoName);
        }

        Pengaduan::create([
            'user_id'         => $currentUser->id ?? session('user_id'),
            'id_alat'         => $request->input('id_alat'),
            'rincian_laporan' => $request->input('rincian_laporan'),
            'foto'            => $fotoName,
            'status'          => 'Pending'
        ]);

        return redirect()->route('pengaduan.riwayat')->with('success', 'Pengaduan berhasil dikirim.');
    }

    // Menghapus pengaduan
    public function destroy($id)
    {
        $pengaduan = Pengaduan::find($id);

        if ($pengaduan) {
            if ($pengaduan->foto) {
                $filePath = public_path('uploads/pengaduan/' . $pengaduan->foto);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $pengaduan->delete();
        }

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }

    // ==========================================
    // FITUR KHUSUS ADMIN (KELOLA PENGADUAN)
    // ==========================================

    // Menampilkan daftar semua pengaduan untuk Admin
    public function adminIndex(Request $request)
    {
        $pengaduan = Pengaduan::all();
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    // Menampilkan form edit status pengaduan (untuk Admin)
    public function edit($id)
    {
        $pengaduan = Pengaduan::find($id);
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    // Mengupdate status pengaduan (untuk Admin)
    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::find($id);
        
        $request->validate([
            'status' => 'required|in:Pending,Proses,Selesai,pending,proses,selesai',
        ]);

        if ($pengaduan) {
            $pengaduan->update([
                'status' => $request->input('status')
            ]);
        }

        return redirect()->route('admin.pengaduan.index')->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}