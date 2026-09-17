@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Daftar Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($data as $kategori)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $kategori->keterangan }}</td>
                <td>
                    <a href="{{ route('admin.kategori.edit', ['id_kategori' => $kategori->id_kategori]) }}" class="btn btn-success btn-sm">Edit</a>
                    <form action="{{ route('admin.kategori.delete', ['id_kategori' => $kategori->id_kategori]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $data->links() !!}
</div>
@endsection