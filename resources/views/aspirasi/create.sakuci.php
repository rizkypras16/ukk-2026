@extends('layouts.app') <!-- Sesuaikan dengan layout utama Sakuci kamu -->

@section('content')
<style>
    /* Paksa warna teks opsi select jadi hitam agar kelihatan di background gelap */
    select option {
        color: #000000 !important;
        background-color: #ffffff !important;
    }
</style>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Aspirasi Baru</h1>
            <p class="mb-0 text-muted">Sampaikan laporan pengaduan atau aspirasi Anda terkait sarana prasarana.</p>
        </div>
        <a href="{{ route('aspirasi.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Aspirasi</h6>
        </div>
        <div class="card-body">
            <!-- Form Kirim Data ke Method Store -->
            <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
    <label for="id_kategori">Kategori <span class="text-danger">*</span></label>
    <select name="id_kategori" id="id_kategori" class="form-control" style="color: #000 !important; background-color: #fff !important;" required>
        <option value="" style="color: #000 !important; background-color: #fff !important;">-- Pilih Kategori --</option>
        @foreach($kategori as $item)
            <option value="{{ $item->id_kategori ?? $item->id }}" style="color: #000 !important; background-color: #fff !important;">
                {{ $item->nama_kategori ?? $item->nama ?? $item->kategori }}
            </option>
        @endforeach
    </select>
</div>
                <!-- Judul Aspirasi -->
                <div class="form-group mb-3">
                    <label for="judul">Judul Pengaduan <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Tuliskan judul singkat..." required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi / Detail Aspirasi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" placeholder="Jelaskan detail permasalahan sarana dan prasarana..." required></textarea>
                </div>

                <!-- Foto Bukti Pendukung -->
                <div class="form-group mb-4">
                    <label for="foto">Foto Bukti Pendukung (Opsional)</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    <small class="text-muted">Format yang didukung: JPG, JPEG, PNG (Maksimal 2MB).</small>
                </div>

                <!-- Tombol Aksi -->
                <div class="form-group">
                    <button type="reset" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Aspirasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection