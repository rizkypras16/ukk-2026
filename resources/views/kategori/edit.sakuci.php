@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Edit Kategori</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori / Keterangan</label>
                    {{-- Menggunakan $kategori->nama_lengkap agar data lama otomatis terisi --}}
                    <input type="text" 
                           class="form-control" 
                           id="nama_kategori" 
                           name="nama_kategori"
                           value="{{ old('nama_kategori', $kategori->nama_lengkap) }}" 
                           required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection