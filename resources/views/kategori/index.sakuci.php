@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Kategori</h2>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card bg-dark text-white border-secondary">
        <div class="card-body p-0">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td class="ps-3">{{ $index + 1 }}</td>
                            <td><span class="badge bg-info text-dark">{{ $item->kode_kategori ?? 'KTG00' . $item->id_kategori }}</span></td>
                            
                            {{-- PERBAIKAN: Mengecek seluruh kemungkinan nama kolom di database --}}
                            <td>{{ $item->nama_kategori ?? $item->nama_lengkap ?? $item->kategori ?? $item->keluhan ?? '-' }}</td>
                            
                            <td class="text-center">
                                <a href="{{ route('admin.kategori.edit', [$item->id_kategori]) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <form action="{{ route('admin.kategori.destroy', [$item->id_kategori]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection