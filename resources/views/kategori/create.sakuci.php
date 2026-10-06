@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Kategori Sarpras')

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
                    <h1 class="sp-title">Tambah <span>Kategori</span> Baru</h1>
                </div>
                <a href="{{ route('admin.kategori.index') }}" class="sp-btn sp-btn--white">← Kembali</a>
            </header>

            {{-- Form --}}
            <div class="sp-box sp-formbox">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf

                    <div class="sp-field">
                        <label for="kategori">Nama Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="Contoh: Alat Praktek, Periferal, dll." required>
                    </div>

                    <div class="sp-formactions">
                        <button type="submit" class="sp-btn">Simpan Kategori</button>
                        <a href="{{ route('admin.kategori.index') }}" class="sp-btn sp-btn--white">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection