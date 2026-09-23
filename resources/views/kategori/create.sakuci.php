@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
        </div>

       <div class="mb-3">
    <label for="kategori" class="form-label">Kategori / Nama Barang</label>
    <select name="kategori" id="kategori" class="form-control" required>
        <option value="">-- Pilih Barang yang Dikeluhkan --</option>
        <option value="Proyektor">Proyektor</option>
        <option value="AC / Kipas Angin">AC / Kipas Angin</option>
        <option value="Meja / Kursi">Meja / Kursi</option>
        <option value="Papan Tulis">Papan Tulis</option>
        <option value="Lampu">Lampu</option>
        <option value="Stopkontak / Listrik">Stopkontak / Listrik</option>
        <option value="Komputer / PC">Komputer / PC</option>
        <option value="Lainnya">Lainnya</option>
    </select>
</div> 

        <div class="form-group mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Keluhan</label>
            <textarea name="keluhan" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
    </form>
</div>
@endsection