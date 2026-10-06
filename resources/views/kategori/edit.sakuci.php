@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Kategori Sarpras')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">
    <link rel="stylesheet" href="/css/sarpras-pages.css">

    <div class="container py-4">
        <div class="sp">

            {{-- Header Halaman --}}
            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ MANAJEMEN SISTEM</span>
                    <h1 class="sp-title">Edit <span>Kategori</span></h1>
                </div>
                <a href="{{ route('admin.kategori.index') }}" class="sp-btn sp-btn--white">← Kembali</a>
            </header>

            {{-- Form --}}
            <div class="sp-box sp-formbox">
                <form action="{{ route('admin.kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="sp-field">
                        <label for="kategori">Nama Kategori</label>
                        <input type="text"
                               id="kategori"
                               name="kategori"
                               value="{{ old('kategori', $kategori->kategori) }}"
                               placeholder="Masukkan nama kategori"
                               required>
                    </div>

                    <div class="sp-formactions">
                        <button type="submit" class="sp-btn">Perbarui Kategori</button>
                        <a href="{{ route('admin.kategori.index') }}" class="sp-btn sp-btn--white">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection