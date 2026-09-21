@extends('layouts.app')

@section('content')

<h1>kategori</h1>
<a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
<table class="table table-bordered mt-3">
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>
    @php $no = 1; @endphp
    @foreach ($data as $d)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $d->kategori }}</td>
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