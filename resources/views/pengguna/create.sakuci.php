@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card bg-dark text-white border-secondary">
        <div class="card-header border-secondary">
            <h5 class="mb-0">Tambah Data Siswa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" name="nama" id="nama" class="form-control bg-secondary text-white border-0" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control bg-secondary text-white border-0" value="{{ old('nis') }}" required>
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control bg-secondary text-white border-0" value="{{ old('kelas') }}" placeholder="Contoh: XII RPL 1" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pengguna.index') }}" class="btn btn-outline-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection