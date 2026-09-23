@extends('layouts.app')

@section('content')

<h1>kategori</h1>
<a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
<table class="table table-bordered mt-3">
    <tr>
        <th>No</th>
        <th>id kategori</th>
        <th>Nama lengkap</th>
        <th>kategori</th>
        <th>kelas</th>
        <th>keluhan</th>
        <th>Aksi</th>
    </tr>
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
           <a href="{{ route('admin.kategori.edit', ['kategori' => $d->id_kategori]) }}" class="btn btn-warning">Edit</a>

           <form action="{{ route('admin.kategori.destroy',  ['kategori' => $d->id_kategori]) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
             <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $data->Links() !!}

@endsection 