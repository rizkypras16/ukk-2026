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
        // Nama field sama dengan kolom tabel kategori: "kategori"
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id_kategori)
    {
        $kategori = Kategori::where('id_kategori', $id_kategori)->first();

        if (!$kategori) {
            return redirect()->route('admin.kategori.index')->with('success', 'Kategori tidak ditemukan.');
        }

        return $this->view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::where('id_kategori', $id_kategori)->first();

        if ($kategori) {
            $kategori->update([
                'kategori' => $request->input('kategori'),
            ]);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id_kategori)
    {
        $kategori = Kategori::where('id_kategori', $id_kategori)->first();

        if ($kategori) {
            $kategori->delete();
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}