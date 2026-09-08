<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {   
    
        $data = Kategori::paginate(5);
        return $this->view('kategori.index', compact('data'));
    }
    public function create(Request $request)
    {
        return $this->view('kategori.create');
}

public function store(request $request)
{
    $request->validate([
         'keterangan' => 'required|string|max:255',
    ]);

return redirect()->route('admin.kategori.index')->with('success', 'kategori berhasil ditambahakan.');
}

public function edit (Request $request,$id)
{
  $kategori = Kategori::findOrFail($id);
  return view('kategori.edit',compact('kategori'));
}

public function update (Request $request,$id)
{
     $request->validate([
        'keteranagan'=> 'required|string|max:255',

     ]);

     return redirect()->route('admin.kategori.index')->with('success','kategori berhasil diperbarui.');
}

public function delete (Request $request,$id)
{
      $kategori = Kategori::findOrFail($id);
    $kategori->delete();

    return redirect()->route('admin.kategori.index')->with('success', 'kategori berhasil dihapus.');
}
}

