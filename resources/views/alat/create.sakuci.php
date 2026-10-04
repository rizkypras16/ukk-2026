@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Alat')

@section('content')

    <style>
        .page-header {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(8, 12, 20, 0.98) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 2rem 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            margin-bottom: 2rem;
        }

        .btn-brand-custom {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            border: none;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s ease;
            padding: 0.65rem 1.5rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-brand-custom:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .custom-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.7), rgba(11, 17, 32, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            overflow: hidden;
        }

        .form-control-custom, .form-select-custom {
            background-color: rgba(30, 41, 59, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #e2e8f0 !important;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus, .form-select-custom:focus {
            background-color: rgba(30, 41, 59, 0.9) !important;
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15) !important;
            color: #ffffff !important;
        }

        .form-control-custom::placeholder {
            color: #64748b;
        }

        .input-group-text-custom {
            background-color: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #38bdf8;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            padding: 0.75rem 1rem;
        }

        .form-label {
            font-weight: 500;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="container-fluid py-4">

        {{-- Header & Tombol Kembali --}}
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1" style="letter-spacing: 2px;">
                    Inventaris Sekolah
                </span>
                <h2 class="text-white fw-bold mb-1" style="letter-spacing: -0.5px;">Tambah Alat Baru</h2>
                <p class="text-secondary small mb-0">Tambahkan inventaris alat atau fasilitas baru ke dalam sistem.</p>
            </div>
            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 fw-semibold px-4 py-2 rounded-3 shadow-sm border-secondary border-opacity-50 text-light">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        {{-- Form Card --}}
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card custom-card">
                    <div class="card-header bg-transparent border-bottom border-secondary border-opacity-15 py-3 px-4">
                        <h5 class="card-title fw-bold text-white mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-plus-circle-fill text-info"></i> Form Inventaris Alat
                        </h5>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('alat.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                {{-- 1. Kategori Alat --}}
                                <div class="col-md-6">
                                    <label for="id_kategori" class="form-label">
                                        Kategori Alat <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text input-group-text-custom"><i class="bi bi-tag-fill"></i></span>
                                        <select name="id_kategori" id="id_kategori" class="form-select form-select-custom @error('id_kategori') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                                    {{ $k->kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_kategori')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 2. Kode Alat --}}
                                <div class="col-md-6">
                                    <label for="kode_alat" class="form-label">
                                        Kode Alat <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text input-group-text-custom"><i class="bi bi-qr-code"></i></span>
                                        <input type="text" class="form-control form-control-custom @error('kode_alat') is-invalid @enderror" id="kode_alat" name="kode_alat" value="{{ old('kode_alat') }}" placeholder="Contoh: ALT-001" required>
                                    </div>
                                    @error('kode_alat')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 3. Nama Alat --}}
                                <div class="col-12">
                                    <label for="nama_alat" class="form-label">
                                        Nama Alat <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text input-group-text-custom"><i class="bi bi-tools"></i></span>
                                        <input type="text" class="form-control form-control-custom @error('nama_alat') is-invalid @enderror" id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}" placeholder="Masukkan nama alat..." required>
                                    </div>
                                    @error('nama_alat')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 4. Kondisi --}}
                                <div class="col-md-6">
                                    <label for="kondisi" class="form-label">
                                        Kondisi <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text input-group-text-custom"><i class="bi bi-info-circle-fill"></i></span>
                                        <input type="text" class="form-control form-control-custom @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" value="{{ old('kondisi') }}" placeholder="Contoh: Baik, Rusak Ringan" required>
                                    </div>
                                    @error('kondisi')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 5. Jumlah --}}
                                <div class="col-md-6">
                                    <label for="jumlah" class="form-label">
                                        Jumlah Unit <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text input-group-text-custom"><i class="bi bi-hash"></i></span>
                                        <input type="number" min="1" class="form-control form-control-custom @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="0" required>
                                    </div>
                                    @error('jumlah')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 6. Lokasi --}}
                                <div class="col-12">
                                    <label for="lokasi" class="form-label">
                                        Lokasi Penyimpanan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text input-group-text-custom"><i class="bi bi-geo-alt-fill"></i></span>
                                        <input type="text" class="form-control form-control-custom @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lab Komputer 1, Gudang Utama" required>
                                    </div>
                                    @error('lokasi')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="pt-4 mt-4 border-top border-secondary border-opacity-15 d-flex gap-2 justify-content-end">
                                <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary px-4 rounded-3 fw-semibold text-light border-secondary border-opacity-50">Batal</a>
                                <button type="submit" class="btn btn-brand-custom d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-floppy-fill"></i>
                                    <span>Simpan Data</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection