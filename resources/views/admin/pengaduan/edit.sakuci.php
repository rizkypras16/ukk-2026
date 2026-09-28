@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header fw-bold">Kelola Status Pengaduan</div>
                <div class="card-body">
                    <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-secondary">Judul / Kerusakan</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" value="{{ $pengaduan->judul ?? $pengaduan->rincian_laporan }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Ubah Status Pengaduan</label>
                            <select name="status" id="status" class="form-select bg-dark text-white border-secondary" required>
                                <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection