@extends('layouts.app')

@section('title', 'Edit Aspirasi')

@php
    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current')
        ? \App\Models\User::current()
        : auth()->user();
    
    // Tentukan route update & cancel berdasarkan role user yang sedang login
    $isAdmin = $currentUser && isset($currentUser->role) && $currentUser->role === 'admin';
    $updateRoute = $isAdmin 
        ? route('admin.aspirasi.update', ['id_aspirasi' => $aspirasi->id_aspirasi]) 
        : route('aspirasi.update', ['id_aspirasi' => $aspirasi->id_aspirasi]);
    $cancelRoute = $isAdmin ? route('admin.aspirasi.index') : route('aspirasi.index');
@endphp

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Penyesuaian Input Group Icon agar fleksibel di Dark/Light Mode */
    .input-group-text-theme {
        background-color: var(--bs-tertiary-bg);
        color: var(--bs-secondary-color);
        border-color: var(--bs-border-color);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-2">
    
    {{-- Header & Tombol Kembali --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-body">Edit Aspirasi</h2>
            <p class="text-body-secondary small mb-0">Perbarui rincian laporan aspirasi atau status pemrosesan.</p>
        </div>
        <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2 rounded-3 shadow-sm">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card border bg-body-tertiary shadow-sm rounded-3">
                <div class="card-header bg-body border-bottom py-3 px-4">
                    <h5 class="card-title fw-bold text-body mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square text-primary"></i> Form Perubahan Aspirasi
                    </h5>
                </div>
                
                <div class="card-body p-4 bg-body">
                    <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- 1. Kategori --}}
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label fw-semibold text-body">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-tag-fill"></i></span>
                                <select name="id_kategori" id="id_kategori" class="form-select bg-body text-body border-secondary-subtle @error('id_kategori') is-invalid @enderror" required>
                                    <option value="" class="bg-body text-body">-- Pilih Kategori --</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id_kategori }}" class="bg-body text-body" {{ old('id_kategori', $aspirasi->id_kategori) == $kat->id_kategori ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_kategori')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold text-body">
                                Judul Aspirasi <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-type-h1"></i></span>
                                <input type="text" class="form-control bg-body text-body border-secondary-subtle @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $aspirasi->judul) }}" placeholder="Masukkan judul aspirasi..." required>
                            </div>
                            @error('judul')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3. Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold text-body">
                                Deskripsi Detail <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control bg-body text-body border-secondary-subtle @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan secara rinci permasalahan..." required>{{ old('deskripsi', $aspirasi->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 4. Status Aspirasi (Khusus Admin) --}}
                        @if($isAdmin)
                            <div class="mb-3">
                                <label for="status" class="form-label fw-semibold text-body">
                                    Status Aspirasi <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-theme"><i class="bi bi-flag-fill"></i></span>
                                    <select name="status" id="status" class="form-select bg-body text-body border-secondary-subtle @error('status') is-invalid @enderror" required>
                                        <option value="Pending" class="bg-body text-body" {{ old('status', $aspirasi->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Proses" class="bg-body text-body" {{ old('status', $aspirasi->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" class="bg-body text-body" {{ old('status', $aspirasi->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        {{-- 5. Pratinjau & Ubah Foto --}}
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold text-body">Foto Bukti Pendukung</label>
                            
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-2">
                                {{-- Foto Saat Ini --}}
                                @if($aspirasi->foto)
                                    <div class="text-center">
                                        <span class="d-block text-body-secondary small mb-1 fw-semibold">Foto Saat Ini:</span>
                                        <a href="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" target="_blank">
                                            <img src="{{ asset('uploads/aspirasi/' . $aspirasi->foto) }}" alt="Foto Bukti Saat Ini" class="rounded border shadow-sm p-1" style="width: 110px; height: 110px; object-fit: cover;">
                                        </a>
                                    </div>
                                @endif

                                {{-- Live Preview Foto Baru --}}
                                <div id="preview-container" class="text-center d-none">
                                    <span class="d-block text-primary small mb-1 fw-semibold">Pratinjau Baru:</span>
                                    <img id="img-preview" src="#" alt="Pratinjau Baru" class="rounded border border-primary shadow-sm p-1" style="width: 110px; height: 110px; object-fit: cover;">
                                </div>
                            </div>

                            <input type="file" class="form-control bg-body text-body border-secondary-subtle @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                            <div class="form-text text-body-secondary">
                                <i class="bi bi-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengganti foto bukti.
                            </div>
                            @error('foto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-3 border-top d-flex gap-2 justify-content-end">
                            <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary px-4 rounded-3 fw-semibold">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm hover-shadow">
                                <i class="bi bi-floppy-fill"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const imgPreview = document.getElementById('img-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
@endpush