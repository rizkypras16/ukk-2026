@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">Daftar Alat</h2>
        <a href="{{ route('alat.create') }}" class="btn btn-primary">Tambah Alat</a>
    </div>

    <div class="card bg-dark text-white border-secondary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama Alat</th>
                            <th>Kode Alat</th>
                            <th>Kondisi</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $d->kategori ?? '-' }}</td>
                            <td>{{ $d->nama_alat }}</td>
                            <td>{{ $d->kode_alat }}</td>
                            <td>{{ $d->kondisi }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>
    <a href="{{ route('alat.edit', ['alat' => $d->id_alat]) }}" class="btn btn-warning btn-sm me-1">Edit</a>
    <form action="{{ route('alat.destroy', ['alat' => $d->id_alat]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
    </form>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection