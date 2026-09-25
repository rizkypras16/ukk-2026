<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Alat;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $data = Alat::orderBy('id_alat', 'desc')->paginate(5);
        return $this->view('alat.index', compact('data'));
    }

    public function create(Request $request)
    {
        return $this->view('alat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'jumlah'    => 'required|numeric',
            'kondisi'   => 'required|string',
        ]);

        // Buat Kode Alat Otomatis (misal: ALT001)
        $terakhir = Alat::orderBy('id_alat', 'desc')->first();
        $nomorUrut = ($terakhir && isset($terakhir->kode_alat)) 
            ? ((int) substr($terakhir->kode_alat, 3)) + 1 
            : 1;
        $kodeOtomatis = 'ALT' . sprintf("%03d", $nomorUrut);

        Alat::create([
            'kode_alat' => $kodeOtomatis,
            'nama_alat' => $request->input('nama_alat'),
            'kategori'  => $request->input('kategori'),
            'jumlah'    => $request->input('jumlah'),
            'kondisi'   => $request->input('kondisi'),
        ]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil ditambahkan.');
    }

    public function edit($id_alat)
    {
        $alat = Alat::findOrFail($id_alat);
        return $this->view('alat.edit', compact('alat'));
    }

    public function update(Request $request, $id_alat)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'jumlah'    => 'required|numeric',
            'kondisi'   => 'required|string',
        ]);

        $alat = Alat::findOrFail($id_alat);
        $alat->update([
            'nama_alat' => $request->input('nama_alat'),
            'kategori'  => $request->input('kategori'),
            'jumlah'    => $request->input('jumlah'),
            'kondisi'   => $request->input('kondisi'),
        ]);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui.');
    }

    public function destroy($id_alat)
    {
        $alat = Alat::findOrFail($id_alat);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus.');
    }
}