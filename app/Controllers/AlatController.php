<?php

namespace App\Controllers;

use App\Models\Alat;

class AlatController
{
    public function index()
    {
        $data = Alat::all();
        return view('alat.index', compact('data'));
    }

    public function create()
    {
        $kategori = Alat::all(); 
        return view('alat.create', compact('kategori'));
    }

    public function store()
    {
        $alat = new Alat();
        $alat->kategori  = $_POST['kategori'] ?? '';
        $alat->nama_alat = $_POST['nama_alat'] ?? '';
        $alat->kode_alat = $_POST['kode_alat'] ?? '';
        $alat->kondisi   = $_POST['kondisi'] ?? '';
        $alat->jumlah    = $_POST['jumlah'] ?? 1;
        
        // Menggunakan method insert() pada instance objek Sakuci
        if (method_exists($alat, 'insert')) {
            $alat->insert();
        } else {
            // Atau menggunakan query langsung dari koneksi Sakuci jika method tidak ada
            \Core\Database\DB::table('alat')->insert([
                'kategori'  => $_POST['kategori'] ?? '',
                'nama_alat' => $_POST['nama_alat'] ?? '',
                'kode_alat' => $_POST['kode_alat'] ?? '',
                'kondisi'   => $_POST['kondisi'] ?? '',
                'jumlah'    => $_POST['jumlah'] ?? 1,
            ]);
        }

        return redirect()->route('alat.index');
    }
}