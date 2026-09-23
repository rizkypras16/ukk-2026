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

        // Validasi disesuaikan menggunakan nama_kategori
       public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required',
        'kategori'     => 'required',
        'kelas'        => 'required',
        'keluhan'      => 'required',
    ]);

    Kategori::create([
        'nama_lengkap' => $request->nama_lengkap,
        'kategori'     => $request->kategori,
        'kelas'        => $request->kelas,
        'keluhan'      => $request->keluhan,
    ]);

    return redirect()->route('admin.kategori.index')->with('success', 'kategori berhasil di tambahkan.');
}

        // 1. Ambil data kategori terakhir untuk menentukan nomor urut berikutnya
        $terakhir = Kategori::orderBy('id_kategori', 'desc')->first();
        
        // 2. Tentukan nomor urut berikutnya
        $nomorUrut = $terakhir && isset($terakhir->kode_kategori) ? ((int) substr($terakhir->kode_kategori, 3)) + 1 : 1;
        
        // 3. Format kode otomatis (misal: KTG001)
        $kodeOtomatis = 'KTG' . sprintf("%03d", $nomorUrut);

        // 4. Simpan ke database dengan kolom yang sesuai
        Kategori::create([
            'kode_kategori' => $kodeOtomatis,
            'nama_lengkap' => $request->input('nama_lengkap'),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return $this->view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id_kategori)
    {
        // Validasi disesuaikan menggunakan nama_kategori
        $request->validate([
            'nama_lengkap' => 'required|string|max:225',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}