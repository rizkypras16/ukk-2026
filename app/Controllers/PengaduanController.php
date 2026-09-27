<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengaduan;
use App\Models\Alat;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        if (session('role') === 'siswa') {
            $pengaduan = Pengaduan::where('user_id', session('user_id'))->get();
        } else {
            $pengaduan = Pengaduan::all();
        }

        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create(Request $request)
    {
        $alat = Alat::all(); 
        return view('pengaduan.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alat'         => 'required',
            'rincian_laporan' => 'required|string',
            'foto'            => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

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
            'user_id'         => session('user_id'),
            'id_alat'         => $request->input('id_alat'),
            'rincian_laporan' => $request->input('rincian_laporan'),
            'foto'            => $fotoName,
            'status'          => 'Pending'
        ]);

        return redirect()->route('pengaduan.riwayat')->with('success', 'Pengaduan berhasil dikirim.');
    }

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

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}