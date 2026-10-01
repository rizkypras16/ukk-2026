@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header border-secondary fw-bold">Tambah Alat Baru</div>
                <div class="card-body">
                    
                    <form action="{{ route('alat.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Alat</label>
                            <select name="kategori" id="kategori" class="form-select bg-dark text-white border-secondary" required>
                                <option value="">-- Pilih Kategori --</option>
                                @if(isset($kategori))
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->nama_kategori ?? $kat->nama ?? $kat->id }}">
                                            {{ $kat->nama_kategori ?? $kat->nama ?? $kat->id }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_alat" class="form-label">Nama Alat</label>
                            <input type="text" name="nama_alat" id="nama_alat" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan nama alat...">
                        </div>

                        <div class="mb-3">
                            <label for="kode_alat" class="form-label">Kode Alat</label>
                            <input type="text" name="kode_alat" id="kode_alat" class="form-control bg-dark text-white border-secondary" required placeholder="Contoh: ALT001">
                        </div>

                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select name="kondisi" id="kondisi" class="form-select bg-dark text-white border-secondary" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control bg-dark text-white border-secondary" required min="1" value="1">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection