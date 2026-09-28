@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Riwayat Pengaduan Saya</span>
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary btn-sm">Buat Pengaduan Baru</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Alat</th>
                                    <th>Rincian Laporan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id_alat }}</td>
                                        <td>{{ $item->rincian_laporan }}</td>
                                        <td>
                                            <span class="badge bg-{{ strtolower($item->status) == 'selesai' ? 'success' : (strtolower($item->status) == 'proses' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary">Belum ada riwayat pengaduan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection