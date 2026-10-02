@extends('layouts.app')

@section('title', 'Kelola Aspirasi & Pengaduan')

@section('content')
<div class="container-fluid py-2">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-body">Kelola Aspirasi & Pengaduan</h2>
            <p class="text-body-secondary small mb-0">Daftar laporan dan aspirasi fasilitas dari siswa.</p>
        </div>
    </div>

    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Data Aspirasi --}}
    <div class="card border bg-body-tertiary shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom">
                        <tr class="text-body-secondary small fw-semibold text-uppercase">
                            <th class="ps-4 py-3" style="width: 60px;">No</th>
                            <th class="py-3" style="min-width: 140px;">Kategori</th>
                            <th class="py-3" style="min-width: 180px;">Judul Laporan</th>
                            <th class="py-3" style="min-width: 120px;">Status</th>
                            <th class="py-3" style="min-width: 150px;">Tanggapan</th>
                            <th class="pe-4 py-3 text-end" style="min-width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-body">
                        @forelse ($data as $index => $item)
                            <tr>
                                {{-- Nomor Urut --}}
                                <td class="ps-4 fw-medium text-body-secondary">
                                   {{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}
                                </td>

                                {{-- Kategori --}}
                                <td>
                                    <span class="badge bg-body-tertiary text-body border px-2.5 py-1.5 fw-normal">
                                        <i class="bi bi-tag-fill me-1 text-primary"></i>
                                        {{ $item->kategori->kategori ?? '-' }}
                                    </span>
                                </td>

                                {{-- Judul --}}
                                <td>
                                    <span class="fw-semibold text-body">{{ $item->judul }}</span>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @php
                                        $status = strtolower($item->status);
                                    @endphp
                                    @if($status == 'selesai')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            Selesai
                                        </span>
                                    @elseif($status == 'proses')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            Proses
                                        </span>
                                    @elseif($status == 'ditolak')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                {{-- Tanggapan --}}
                                <td>
                                    <span class="text-body-secondary small">
                                        {{ $item->tanggapan ?? 'Belum ditanggapi' }}
                                    </span>
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.aspirasi.edit', ['id_aspirasi' => $item->id_aspirasi]) }}" class="btn btn-sm btn-warning text-dark rounded-2 d-inline-flex align-items-center gap-1" title="Tanggapi / Edit">
                                            <i class="bi bi-chat-square-text-fill"></i>
                                            <span class="d-none d-xl-inline">Tanggapi</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-body-secondary">
                                        <i class="bi bi-inbox fs-1 d-block mb-2 text-body-tertiary"></i>
                                        <h6 class="fw-semibold text-body">Belum Ada Aspirasi / Pengaduan</h6>
                                        <p class="small mb-0">Laporan dari siswa akan muncul di sini.</p>
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