@extends('layouts.app')

@section('title', config('app.name') . ' -- Data Kategori Sarpras')

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

        .table-dark-custom {
            background-color: transparent !important;
            color: #e2e8f0;
            margin-bottom: 0;
        }

        .table-dark-custom th {
            background: rgba(30, 41, 59, 0.8) !important;
            color: #38bdf8;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .table-dark-custom td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
            color: #cbd5e1;
        }

        .table-dark-custom tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-dark-custom tbody tr:hover {
            background-color: rgba(30, 41, 59, 0.4) !important;
        }

        .badge-kode {
            background: rgba(6, 182, 212, 0.15) !important;
            border: 1px solid rgba(6, 182, 212, 0.3);
            color: #38bdf8 !important;
            font-weight: 600;
            padding: 0.4em 0.8em;
            border-radius: 8px;
        }

        .btn-action-edit {
            background: rgba(234, 179, 8, 0.15);
            border: 1px solid rgba(234, 179, 8, 0.3);
            color: #facc15;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            padding: 0.4rem 0.9rem;
            font-size: 0.85rem;
        }

        .btn-action-edit:hover {
            background: rgba(234, 179, 8, 0.3);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-action-delete {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            padding: 0.4rem 0.9rem;
            font-size: 0.85rem;
        }

        .btn-action-delete:hover {
            background: rgba(239, 68, 68, 0.3);
            color: #fff;
            transform: translateY(-1px);
        }

        .alert-success-custom {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
            border-radius: 14px;
            padding: 1rem 1.25rem;
            font-weight: 500;
        }
    </style>

    <div class="container py-4">
        {{-- Header Halaman --}}
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1" style="letter-spacing: 2px;">
                    Manajemen Sistem
                </span>
                <h2 class="text-white fw-bold mb-0" style="letter-spacing: -0.5px;">Data Kategori</h2>
            </div>
            <a href="{{ route('kategori.create') }}" class="btn btn-brand-custom shadow">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success-custom shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="card custom-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Kode Kategori</th>
                                <th>Nama Kategori</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td class="ps-4 text-secondary fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge badge-kode">
                                            {{ $item->kode_kategori ?? 'KTG00' . $item->id_kategori }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-medium text-white">
                                            {{ $item->nama_kategori ?? $item->nama_lengkap ?? $item->kategori ?? $item->keluhan ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.kategori.edit', [$item->id_kategori]) }}" class="btn btn-action-edit">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.kategori.destroy', [$item->id_kategori]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-action-delete">
                                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-secondary">
                                        <div class="py-3">
                                            <i class="bi bi-folder2-open display-6 d-block mb-2 text-muted"></i>
                                            Belum ada data kategori yang tersedia.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection