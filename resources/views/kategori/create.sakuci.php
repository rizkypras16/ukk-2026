@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Kategori Sarpras')

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

        .custom-card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.7), rgba(11, 17, 32, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            overflow: hidden;
        }

        .form-label-custom {
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control-custom {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            background: rgba(30, 41, 59, 0.9);
            border-color: #38bdf8;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }

        .form-control-custom::placeholder {
            color: #64748b;
        }

        .btn-brand-custom {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            border: none;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s ease;
            padding: 0.7rem 1.75rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-brand-custom:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary-custom {
            background: rgba(100, 116, 139, 0.15);
            border: 1px solid rgba(100, 116, 139, 0.3);
            color: #cbd5e1;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s ease;
            padding: 0.7rem 1.75rem;
        }

        .btn-secondary-custom:hover {
            background: rgba(100, 116, 139, 0.3);
            color: #ffffff;
            transform: translateY(-2px);
        }
    </style>

    <div class="container py-4">
        {{-- Header Halaman --}}
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1" style="letter-spacing: 2px;">
                    Manajemen Sistem
                </span>
                <h2 class="text-white fw-bold mb-0" style="letter-spacing: -0.5px;">Tambah Kategori Baru</h2>
            </div>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary-custom shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        {{-- Form Card --}}
        <div class="card custom-card">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="kategori" class="form-label form-label-custom">
                            <i class="bi bi-tag-fill text-info me-1"></i> Nama Kategori
                        </label>
                        <input type="text" class="form-control form-control-custom" id="kategori" name="kategori" placeholder="Contoh: Alat Prakttek, Periferal, dll." required>
                    </div>

                    <div class="d-flex flex-wrap gap-3 pt-2">
                        <button type="submit" class="btn btn-brand-custom shadow">
                            <i class="bi bi-check-lg me-1"></i> Simpan Kategori
                        </button>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary-custom">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection