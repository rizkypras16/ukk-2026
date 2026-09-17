@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">Batal</button>
    </form>
</div>

@endsection