@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kategori</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th></th>Aksi</th>
</tr>
</thead>
<tbody>
    @foreach ($data as $kategori)
    <tr>
        <td>{{ $kategori->id_kategori }}</td>
        <td>{{ $kategori->keterangan }}</td>
        <td>
            <a href="" class="btn-success btn-sm">edit</a>
            <a href="" class="btn-success btn-sm">hapus</a>
</td>
</tr>
@endforeach
</tbody>
</table>
{!! $data->Links() !!}
</div>
@endsection


