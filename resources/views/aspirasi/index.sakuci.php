@extends('layouts.app')

@section('title', config('app.name') . ' -- Kelola Aspirasi & Pengaduan')

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

        .table-custom {
            color: #e2e8f0 !important;
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table-custom th {
            background-color: rgba(30, 41, 59, 0.5) !important;
            color: #94a3b8 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            background-color: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
            color: #cbd5e1 !important;
            padding: 1rem 1.25rem;
        }

        .table-hover tbody tr:hover td {
            background-color: rgba(30, 41, 59, 0.4) !important;
            color: #ffffff !important;
        }

        .badge-custom-category {
            background-color: rgba(30, 41, 59, 0.8);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.2);
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .btn-action-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #0f172a;
            border: none;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.25s ease;
            padding: 0.4rem 0.85rem;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
        }

        .btn-action-warning:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        }
    </style>

    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="text-secondary small fw-semibold text-uppercase d-block mb-1" style="letter-spacing: 2px;">
                    Panel Administrator
                </span>
                <h2 class="text-white fw-bold mb-1" style="letter-spacing: -0.5px;">Kelola Aspirasi & Pengaduan</h2>
                <p class="text-secondary small mb-0">Daftar laporan dan aspirasi fasilitas dari siswa.</p>
            </div>
        </div>

        {{-- Alert Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center gap-3 py-3 px-4" role="alert" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3) !important;">
                <i class="bi bi-check-circle-fill fs-4"></i>
                <div class="fw-medium">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabel Data Aspirasi --}}
        <div class="card custom-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4 py-3" style="width: 60px;">No</th>
                                <th class="py-3" style="min-width: 140px;">Kategori</th>
                                <th class="py-3" style="min-width: 180px;">Judul Laporan</th>
                                <th class="py-3" style="min-width: 120px;">Status</th>
                                <th class="py-3" style="min-width: 180px;">Tanggapan</th>
                                <th class="pe-4 py-3 text-end" style="min-width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                                <tr>
                                    {{-- Nomor Urut --}}
                                    <td class="ps-4 fw-semibold text-secondary">
                                        {{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}
                                    </td>

                                    {{-- Kategori --}}
                                    <td>
                                        <span class="badge-custom-category d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-tag-fill text-info"></i>
                                            {{ $item->kategori->kategori ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Judul --}}
                                    <td>
                                        <span class="fw-semibold text-white">{{ $item->judul }}</span>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @php
                                            $status = strtolower($item->status);
                                        @endphp
                                        @if($status == 'selesai')
                                            <span class="badge px-3 py-1.5 rounded-pill fw-semibold" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3);">
                                                Selesai
                                            </span>
                                        @elseif($status == 'proses')
                                            <span class="badge px-3 py-1.5 rounded-pill fw-semibold" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3);">
                                                Proses
                                            </span>
                                        @elseif($status == 'ditolak')
                                            <span class="badge px-3 py-1.5 rounded-pill fw-semibold" style="background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3);">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="badge px-3 py-1.5 rounded-pill fw-semibold" style="background: rgba(100, 116, 139, 0.15); color: #94a3b8; border: 1px solid rgba(100, 116, 139, 0.3);">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Tanggapan --}}
                                    <td>
                                        <span class="text-secondary small">
                                            {{ $item->tanggapan ?? 'Belum ditanggapi' }}
                                        </span>
                                    </td>

                                    {{-- Tombol Aksi --}}
                                    <td class="pe-4 text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.aspirasi.edit', ['id_aspirasi' => $item->id_aspirasi]) }}" class="btn btn-sm btn-action-warning d-inline-flex align-items-center gap-1" title="Tanggapi / Edit">
                                                <i class="bi bi-chat-square-text-fill"></i>
                                                <span class="d-none d-xl-inline">Tanggapi</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-secondary py-4">
                                            <i class="bi bi-inbox fs-1 d-block mb-3 text-secondary opacity-50"></i>
                                            <h6 class="fw-bold text-white mb-1">Belum Ada Aspirasi / Pengaduan</h6>
                                            <p class="small mb-0 text-secondary">Laporan dari siswa akan muncul di sini.</p>
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