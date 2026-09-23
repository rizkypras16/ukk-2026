<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $data = Kategori::orderBy('id_kategori', 'desc')->paginate(5);
        return $this->view('kategori.index', compact('data'));
    }

    public function create(Request $request)
    {
        return $this->view('kategori.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'kategori'     => 'required',
            'kelas'        => 'required',
            'keluhan'      => 'required',
        ]);

        // 2. Ambil data kategori terakhir untuk menentukan nomor urut berikutnya
        $terakhir = Kategori::orderBy('id_kategori', 'desc')->first();

        // 3. Tentukan nomor urut berikutnya
        $nomorUrut = ($terakhir && isset($terakhir->kode_kategori)) 
            ? ((int) substr($terakhir->kode_kategori, 3)) + 1 
            : 1;

        // 4. Format kode otomatis (misal: KTG001)
        $kodeOtomatis = 'KTG' . sprintf("%03d", $nomorUrut);

        // 5. Simpan ke database
        Kategori::create([
            'kode_kategori' => $kodeOtomatis,
            'nama_lengkap'  => $request->input('nama_lengkap'),
            'kategori'      => $request->input('kategori'),
            'kelas'         => $request->input('kelas'),
            'keluhan'       => $request->input('keluhan'),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return $this->view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}