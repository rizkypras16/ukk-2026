<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data alat beserta relasi kategorinya
        $data = Alat::with('kategori')
            ->orderBy('id_alat', 'desc')
            ->paginate(5);

        return view('alat.index', compact('data'));
    }

    public function create(Request $request)
    {
        // Mengambil semua data kategori untuk isi opsi dropdown
        $kategori = Kategori::all();

        return view('alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|numeric',
            'nama_alat'   => 'required|string|max:100',
        ]);

        // Kode alat dibuat otomatis (ALT001, ALT002, ...) dan dipastikan belum dipakai
        $nomor = Alat::count() + 1;
        do {
            $kodeOtomatis = 'ALT' . sprintf('%03d', $nomor);
            $nomor++;
        } while (Alat::where('kode_alat', $kodeOtomatis)->first());

        Alat::create([
            'id_kategori' => $request->id_kategori,
            'kode_alat'   => $kodeOtomatis,
            'nama_alat'   => $request->nama_alat,
        ]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil ditambahkan');
    }

    public function edit($alat)
    {
        $data_alat = Alat::where('id_alat', $alat)->first();
        $kategori = Kategori::all(); // Ambil semua kategori untuk dropdown di halaman edit

        return view('alat.edit', compact('data_alat', 'kategori'));
    }

    public function update(Request $request, $alat)
    {
        $request->validate([
            'id_kategori' => 'required|numeric',
            'nama_alat'   => 'required|string|max:100',
        ]);

        $data_alat = Alat::where('id_alat', $alat)->first();
        $data_alat->update([
            'id_kategori' => $request->id_kategori,
            'nama_alat'   => $request->nama_alat,
        ]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {
        $alat = Alat::where('id_alat', $id)->first();
        if ($alat) {
            $alat->delete();
        }

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus.');
    }
}