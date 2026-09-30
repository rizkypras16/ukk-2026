@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
<div class="container py-4" style="max-width: 600px;">
    <h4 class="fw-bold mb-4">Tambah Data Alat</h4>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('alat.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @if(isset($kategoris))
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Alat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection