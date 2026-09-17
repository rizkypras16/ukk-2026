@extends ('layouts.app')

@section ('content')
    <div class="container">
        <h1>Data Kategori</h1>
        <form action="{{ route('admin.kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $kategori->keterangan }}" required>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Simpan</button>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Batal</button>
        </form>
    </div>
@endsection  