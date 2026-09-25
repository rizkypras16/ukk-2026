@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Kategori</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Kategori</th>
                <th>Nama Lengkap</th>
                <th>Kategori</th>
                <th>Kelas</th>
                <th>Keluhan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($data as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->id_kategori }}</td>
                <td>{{ $d->nama_lengkap }}</td>
                <td>{{ $d->kategori }}</td>
                <td>{{ $d->kelas }}</td>
                <td>{{ $d->keluhan }}</td>
                <td>
                    <a href="{{ route('admin.kategori.edit', ['kategori' => $d->id_kategori]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kategori.destroy', ['kategori' => $d->id_kategori]) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $data->links() !!}
</div>
@endsection