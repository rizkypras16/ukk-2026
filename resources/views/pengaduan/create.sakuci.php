@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header border-secondary fw-bold">Buat Pengaduan Sarana & Prasarana</div>
                <div class="card-body">
                    
                    @if (isset($errors) && method_exists($errors, 'any') && $errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="id_alat" class="form-label">Pilih Alat / Sarana</label>
                            <select name="id_alat" id="id_alat" class="form-select bg-dark text-white border-secondary" required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach ($alat as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_alat ?? $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="rincian_laporan" class="form-label">Deskripsi / Detail Kerusakan</label>
                            <textarea name="rincian_laporan" id="rincian_laporan" rows="4" class="form-control bg-dark text-white border-secondary" required placeholder="Jelaskan kerusakan secara detail..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Bukti Kerusakan (Opsional)</label>
                            <input type="file" name="foto" id="foto" class="form-control bg-dark text-white border-secondary" accept="image/png, image/jpeg, image/jpg">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim Pengaduan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection