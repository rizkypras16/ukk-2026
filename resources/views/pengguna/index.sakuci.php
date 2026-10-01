@extends('layouts.app')

@section('title', 'Kelola Aspirasi & Pengaduan')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-body">
                {{ isset($currentUser->role) && $currentUser->role === 'admin' ? 'Kelola Aspirasi & Pengaduan' : 'Pengaduan Saya' }}
            </h2>
            <p class="text-body-secondary small mb-0">
                {{ isset($currentUser->role) && $currentUser->role === 'admin' ? 'Daftar seluruh laporan dan aspirasi fasilitas dari siswa.' : 'Pantau status laporan kerusakan atau aspirasi fasilitas sekolah yang pernah kamu kirim.' }}
            </p>
        </div>
        
        @if(!isset($currentUser->role) || $currentUser->role !== 'admin')
            <div>
                <a href="{{ route('aspirasi.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm">
                    <i class="bi bi-plus-circle-fill fs-5"></i>
                    <span class="fw-semibold">Buat Pengaduan Baru</span>
                </a>
            </div>
        @endif
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
                            <th class="py-3" style="min-width: 180px;">Tanggapan</th>
                            <th class="pe-4 py-3 text-end" style="min-width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-body">
                        {{-- Gunakan variabel $data atau $aspirasi mana saja yang dikirim controller --}}
                        @php
                            $listData = $data ?? ($aspirasi ?? collect());
                        @endphp

                        @forelse ($listData as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-body-secondary">
                                    {{ method_exists($listData, 'firstItem') ? $listData->firstItem() + $index : $index + 1 }}
                                </td>

                                <td>
                                    <span class="badge bg-body-tertiary text-body border px-2.5 py-1.5 fw-normal">
                                        <i class="bi bi-tag-fill me-1 text-primary"></i>
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="fw-semibold text-body d-block">{{ $item->judul }}</span>
                                    <small class="text-body-secondary">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</small>
                                </td>

                                <td>
                                    @php
                                        $status = strtolower($item->status);
                                    @endphp
                                    @if($status == 'selesai')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            <i class="bi bi-check-circle me-1"></i> Selesai
                                        </span>
                                    @elseif($status == 'proses')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            <i class="bi bi-arrow-repeat me-1"></i> Proses
                                        </span>
                                    @elseif($status == 'ditolak')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            <i class="bi bi-x-circle me-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                            <i class="bi bi-clock me-1"></i> Pending
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="text-body-secondary small">
                                        {{ $item->tanggapan ?? 'Belum ditanggapi' }}
                                    </span>
                                </td>

                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-1">
                                        @if(isset($currentUser->role) && $currentUser->role === 'admin')
                                            <a href="{{ route('admin.aspirasi.edit', ['id_aspirasi' => $item->id_aspirasi]) }}" class="btn btn-sm btn-warning text-dark rounded-2 d-inline-flex align-items-center gap-1" title="Tanggapi / Edit">
                                                <i class="bi bi-chat-square-text-fill"></i>
                                                <span>Tanggapi</span>
                                            </a>
                                        @else
                                            <a href="{{ route('aspirasi.show', ['id_aspirasi' => $item->id_aspirasi]) }}" class="btn btn-sm btn-outline-primary rounded-2 d-inline-flex align-items-center gap-1" title="Lihat Detail">
                                                <i class="bi bi-eye-fill"></i>
                                                <span>Detail</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-body-secondary py-4">
                                        <i class="bi bi-journal-x fs-1 d-block mb-3 text-body-tertiary"></i>
                                        <h5 class="fw-semibold text-body">Belum Ada Pengaduan</h5>
                                        <p class="small mb-3">Belum ada data laporan atau aspirasi yang masuk.</p>
                                        @if(!isset($currentUser->role) || $currentUser->role !== 'admin')
                                            <a href="{{ route('aspirasi.create') }}" class="btn btn-sm btn-primary px-3 rounded-pill">
                                                Buat Pengaduan Pertamamu
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(method_exists($listData, 'hasPages') && $listData->hasPages())
            <div class="card-footer bg-body border-top py-3">
                {{ $listData->links() }}
            </div>
        @endif
    </div>
</div>
@endsection