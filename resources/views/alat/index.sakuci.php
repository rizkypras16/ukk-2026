@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Alat & Fasilitas Sarpras')

@php
    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
        ? \App\Models\User::current() 
        : auth()->user();
    
    // Cek apakah user berhak menambah/mengedit data (bukan siswa)
    $canManage = $currentUser && isset($currentUser->role) && $currentUser->role !== 'siswa';
@endphp

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

        .badge-kategori {
            background: rgba(56, 189, 248, 0.1) !important;
            border: 1px solid rgba(56, 189, 248, 0.25);
            color: #38bdf8 !important;
            font-weight: 500;
            padding: 0.4em 0.8em;
            border-radius: 8px;
        }

        .badge-kode-alat {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #38bdf8;
            font-family: monospace;
            padding: 0.35rem 0.65rem;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .badge-jumlah {
            background: rgba(100, 116, 139, 0.2);
            border: 1px solid rgba(100, 116, 139, 0.3);
            color: #e2e8f0;
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
            padding: 0.4rem 0.8rem;
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
            padding: 0.4rem 0.8rem;
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

    <div class="container-fluid py-4">

        {{-- Header Halaman & Tombol Tambah --}}
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1" style="letter-spacing: 2px;">
                    Inventaris Sekolah
                </span>
                <h2 class="text-white fw-bold mb-1" style="letter-spacing: -0.5px;">Daftar Alat & Fasilitas</h2>
                <p class="text-secondary small mb-0">Kelola dan pantau inventaris sarana prasarana sekolah secara transparan.</p>
            </div>

            @if($canManage)
                <a href="{{ route('alat.create') }}" class="btn btn-brand-custom shadow d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Tambah Alat</span>
                </a>
            @endif
        </div>

        {{-- Alert Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert alert-success-custom shadow-sm mb-4 d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="card custom-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4 py-3" style="width: 60px;">No</th>
                                <th class="py-3" style="min-width: 140px;">Kategori</th>
                                <th class="py-3" style="min-width: 180px;">Nama Alat</th>
                                <th class="py-3" style="min-width: 120px;">Kode Alat</th>
                                <th class="py-3" style="min-width: 130px;">Kondisi</th>
                                <th class="py-3 text-center" style="width: 100px;">Jumlah</th>
                                <th class="py-3" style="min-width: 160px;">Lokasi</th>
                                @if($canManage)
                                    <th class="pe-4 py-3 text-end" style="min-width: 140px;">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $d)
                                <tr>
                                    {{-- Nomor Urut --}}
                                    <td class="ps-4 text-secondary fw-semibold">
                                        {{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}
                                    </td>

                                    {{-- Kategori --}}
                                    <td>
                                        <span class="badge badge-kategori d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-tag-fill text-info"></i>
                                            {{ $d->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Nama Alat --}}
                                    <td>
                                        <span class="fw-semibold text-white">{{ $d->nama_alat }}</span>
                                    </td>

                                    {{-- Kode Alat --}}
                                    <td>
                                        <span class="badge-kode-alat">
                                            {{ $d->kode_alat }}
                                        </span>
                                    </td>

                                    {{-- Kondisi Dinamis --}}
                                    <td>
                                        @php
                                            $kondisi = strtolower($d->kondisi);
                                        @endphp

                                        @if(str_contains($kondisi, 'baik'))
                                            <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-check-circle-fill"></i> {{ $d->kondisi }}
                                            </span>
                                        @elseif(str_contains($kondisi, 'ringan'))
                                            <span class="badge bg-warning bg-opacity-15 text-warning border border-warning border-opacity-25 px-2.5 py-1.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-exclamation-triangle-fill"></i> {{ $d->kondisi }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-15 text-danger border border-danger border-opacity-25 px-2.5 py-1.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-x-circle-fill"></i> {{ $d->kondisi }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Jumlah --}}
                                    <td class="text-center">
                                        <span class="badge badge-jumlah">
                                            {{ $d->jumlah }}
                                        </span>
                                    </td>

                                    {{-- Lokasi --}}
                                    <td>
                                        <span class="text-secondary small d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-geo-alt-fill text-danger"></i>
                                            {{ $d->lokasi }}
                                        </span>
                                    </td>

                                    {{-- Tombol Aksi --}}
                                    @if($canManage)
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex gap-2">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('alat.edit', ['alat' => $d->id_alat]) }}" class="btn btn-action-edit" title="Edit">
                                                    <i class="bi bi-pencil-square"></i> <span class="d-none d-xl-inline">Edit</span>
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('alat.destroy', ['alat' => $d->id_alat]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-action-delete" title="Hapus">
                                                        <i class="bi bi-trash-fill"></i> <span class="d-none d-xl-inline">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $canManage ? 8 : 7 }}" class="text-center py-5">
                                        <div class="text-secondary py-3">
                                            <i class="bi bi-tools display-6 d-block mb-2 text-muted"></i>
                                            <h6 class="fw-semibold text-white">Belum Ada Data Alat</h6>
                                            <p class="small mb-0 text-secondary">Silakan tambahkan data alat inventaris baru melalui tombol di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination Footer --}}
            @if(method_exists($data, 'hasPages') && $data->hasPages())
                <div class="card-footer bg-transparent border-top border-secondary border-opacity-10 py-3 px-4">
                    <div class="d-flex justify-content-end">
                        {!! $data->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection