@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Pengguna')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    

    <div class="container py-4">
        <div class="sp">

            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ MANAJEMEN SISTEM</span>
                    <h1 class="sp-title">Tambah <span>Pengguna</span> Baru</h1>
                    <p class="sp-lead">Akun login dibuat otomatis: username dari nama (tanpa spasi), password awal 123456.</p>
                </div>
                <a href="{{ route('admin.pengguna.index') }}" class="sp-btn sp-btn--white">← Kembali</a>
            </header>

            <div class="sp-box sp-formbox">
                <form action="{{ route('admin.pengguna.store') }}" method="POST">
                    @csrf

                    <div class="sp-field">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama siswa..." required>
                        @error('nama')
                            <div class="sp-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sp-row2">
                        <div class="sp-field">
                            <label for="nis">NIS *</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 1234567" required>
                            @error('nis')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="kelas">Kelas *</label>
                            <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XI RPL" maxlength="10" required>
                            @error('kelas')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-formactions">
                        <button type="submit" class="sp-btn">Simpan Data</button>
                        <a href="{{ route('admin.pengguna.index') }}" class="sp-btn sp-btn--white">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection