@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf
    <div class="form-group">
    <div class="form-group"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
        <div class="form-group"><label>Kelas</label><input type="text" name="kelas" class="form-control" required></div>
        <div class="form-group"><label>Keluhan</label><textarea name="keluhan" class="form-control" required></textarea></div> 
        <label for="keterangan">Kategori</label>
        <input type="text"  class="form-control" id="keterangan" name="keterangan" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
</form>
</div>
@endsection