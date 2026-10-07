@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Alat')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">
    <link rel="stylesheet" href="/css/sarpras-pages.css">

    <div class="container py-4">
        <div class="sp">

            {{-- Header Halaman --}}
            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ INVENTARIS SEKOLAH</span>
                    <h1 class="sp-title">Tambah <span>Alat</span> Baru</h1>
                    <p class="sp-lead">Tambahkan inventaris alat atau fasilitas baru ke dalam sistem.</p>
                </div>
                <a href="{{ route('alat.index') }}" class="sp-btn sp-btn--white">← Kembali</a>
            </header>

            {{-- Form --}}
            <div class="sp-box sp-formbox">
                <form action="{{ route('alat.store') }}" method="POST">
                    @csrf

                    <div class="sp-row2">
                        <div class="sp-field">
                            <label for="id_kategori">Kategori Alat *</label>
                            <select name="id_kategori" id="id_kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori ?? $k->nama_lengkap ?? $k->kategori ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="kode_alat">Kode Alat *</label>
                            <input type="text" id="kode_alat" name="kode_alat" value="{{ old('kode_alat') }}" placeholder="Contoh: ALT-001" required>
                            @error('kode_alat')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-field">
                        <label for="nama_alat">Nama Alat *</label>
                        <input type="text" id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}" placeholder="Masukkan nama alat..." required>
                        @error('nama_alat')
                            <div class="sp-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sp-row2">
                        <div class="sp-field">
                            <label for="kondisi">Kondisi *</label>
                            <input type="text" id="kondisi" name="kondisi" value="{{ old('kondisi') }}" placeholder="Contoh: Baik, Rusak Ringan" required>
                            @error('kondisi')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sp-field">
                            <label for="jumlah">Jumlah Unit *</label>
                            <input type="number" min="1" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="0" required>
                            @error('jumlah')
                                <div class="sp-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sp-field">
                        <label for="lokasi">Lokasi Penyimpanan *</label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Lab Komputer 1, Gudang Utama" required>
                        @error('lokasi')
                            <div class="sp-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sp-formactions">
                        <button type="submit" class="sp-btn">Simpan Data</button>
                        <a href="{{ route('alat.index') }}" class="sp-btn sp-btn--white">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection