@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengguna')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">
    <link rel="stylesheet" href="/css/sarpras-pages.css">

    <div class="container py-4">
        <div class="sp">

            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ MANAJEMEN SISTEM</span>
                    <h1 class="sp-title">Edit <span>Pengguna</span></h1>
                </div>
                <a href="{{ route('admin.pengguna.index') }}" class="sp-btn sp-btn--white">← Kembali</a>
            </header>

            <div class="sp-box sp-formbox">
                <form action="{{ route('admin.pengguna.update', ['pengguna' => $siswa->id_siswa]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="sp-field">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
                        @error('nama')
                            <div class="sp-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sp-row2">
                        <div class="sp-field">
                            <label for="nis">NIS *</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" required>
                            @error('nis')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="kelas">Kelas *</label>
                            <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" maxlength="10" required>
                            @error('kelas')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-formactions">
                        <button type="submit" class="sp-btn">Perbarui Data</button>
                        <a href="{{ route('admin.pengguna.index') }}" class="sp-btn sp-btn--white">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection