@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-white mb-0">Riwayat Pengaduan Saya</h4>
        <a href="{{ url('/pengaduan/tambah') }}" class="btn btn-primary btn-sm">+ Buat Pengaduan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-dark text-white border-secondary shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Judul Pengaduan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggapan Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($pengaduan) && count($pengaduan) > 0)
                            @foreach ($pengaduan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $item->judul }}</span>
                                        <br>
                                        <small class="text-secondary">{{ $item->deskripsi }}</small>
                                    </td>
                                    <td>{{ $item->lokasi ?? '-' }}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif ($item->status == 'proses')
                                            <span class="badge bg-info text-dark">Diproses</span>
                                        @elseif ($item->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->tanggapan ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4 text-secondary">
                                    Belum ada pengaduan yang dikirim.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection