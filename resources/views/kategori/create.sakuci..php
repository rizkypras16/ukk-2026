@extends.('layout.app')

@section.('content')

<div classs="container">
    <h1>Tambah Kategori</h1>
    <form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf
    <div class="form-gruop">
        <label for="keterangan">Keterangan</label>
        <input type="text"  class="form-control" id="keterangan" name="keterangan" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
</form>
</div>
@endsection