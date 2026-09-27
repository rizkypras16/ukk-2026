@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-white m-0">Daftar Pengaduan Sarana & Prasarana</h3>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card bg-dark text-white border-secondary">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead class="table-secondary text-dark">
                        <tr>
                            <th class="py-3 px-3">No</th>
                            <th class="py-3">Pelapor</th>
                            <th class="py-3">Judul / Kerusakan</th>
                            <th class="py-3">Lokasi</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($pengaduans) && count($pengaduans) > 0)
                            @foreach($pengaduans as $index => $p)
                                <tr>
                                    <td class="px-3">{{ $index + 1 }}</td>
                                    <td>{{ $p->user->username ?? 'Siswa' }}</td>
                                    <td class="fw-semibold">{{ $p->judul }}</td>
                                    <td>{{ $p->lokasi }}</td>
                                    <td>
                                        <span class="badge bg-{{ $p->status == 'selesai' ? 'success' : ($p->status == 'proses' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($p->status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.pengaduan.edit', $p->id) }}" class="btn btn-sm btn-outline-warning">Kelola</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4 text-secondary">Belum ada data pengaduan masuk.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection