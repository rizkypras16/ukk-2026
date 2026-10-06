@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Alat & Fasilitas Sarpras')

@php
    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
        ? \App\Models\User::current() 
        : auth()->user();
    
    // Cek apakah user berhak menambah/mengedit data (bukan siswa)
    $canManage = $currentUser && isset($currentUser->role) && $currentUser->role !== 'siswa';
@endphp

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">
    <link rel="stylesheet" href="/css/sarpras-pages.css">

    <div class="container-fluid py-4">
        <div class="sp">

            {{-- Header Halaman & Tombol Tambah --}}
            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ INVENTARIS SEKOLAH</span>
                    <h1 class="sp-title">Daftar <span>Alat</span> &amp; Fasilitas</h1>
                    <p class="sp-lead">Kelola dan pantau inventaris sarana prasarana sekolah secara transparan.</p>
                </div>

                @if($canManage)
                    <a href="{{ route('alat.create') }}" class="sp-btn">+ Tambah Alat</a>
                @endif
            </header>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="sp-alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup">✕</button>
                </div>
            @endif

            {{-- Tabel Data --}}
            <div class="sp-box" style="margin-top:26px;overflow:hidden">
                <div class="sp-tablewrap" style="margin-top:0;box-shadow:none;border:0;border-radius:0">
                    <table class="sp-table">
                        <thead>
                            <tr>
                                <th style="width:60px">No</th>
                                <th>Kategori</th>
                                <th>Nama Alat</th>
                                <th>Kode Alat</th>
                                <th>Kondisi</th>
                                <th class="sp-c">Jumlah</th>
                                <th>Lokasi</th>
                                @if($canManage)
                                    <th class="sp-r">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $d)
                                @php
                                    $kondisi = strtolower($d->kondisi);
                                    $kelasKondisi = str_contains($kondisi, 'baik') ? 'baik' : (str_contains($kondisi, 'ringan') ? 'ringan' : 'berat');
                                @endphp
                                <tr>
                                    <td><strong>{{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}</strong></td>
                                    <td><span class="sp-tag">{{ $d->kategori->nama_kategori ?? '-' }}</span></td>
                                    <td><span class="sp-name">{{ $d->nama_alat }}</span></td>
                                    <td><span class="sp-code">{{ $d->kode_alat }}</span></td>
                                    <td><span class="sp-st sp-st--{{ $kelasKondisi }}">{{ $d->kondisi }}</span></td>
                                    <td class="sp-c"><span class="sp-count">{{ $d->jumlah }}</span></td>
                                    <td><span class="sp-muted">{{ $d->lokasi }}</span></td>

                                    @if($canManage)
                                        <td class="sp-r">
                                            <div class="sp-actions">
                                                <a href="{{ route('alat.edit', ['alat' => $d->id_alat]) }}" class="sp-btn sp-btn--sm sp-btn--amber" title="Edit">Edit</a>

                                                <form action="{{ route('alat.destroy', ['alat' => $d->id_alat]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="sp-btn sp-btn--sm sp-btn--coral" title="Hapus">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $canManage ? 8 : 7 }}" class="sp-empty">
                                        <h3>Belum Ada Data Alat</h3>
                                        <p class="sp-muted">Silakan tambahkan data alat inventaris baru melalui tombol di atas.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Footer --}}
                @if(method_exists($data, 'hasPages') && $data->hasPages())
                    <div class="sp-pager">
                        {!! $data->links('pagination::bootstrap-5') !!}
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection