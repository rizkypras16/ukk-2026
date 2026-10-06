@extends('layouts.app')

@section('title', config('app.name') . ' -- Kelola Aspirasi & Pengaduan')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">
    <link rel="stylesheet" href="/css/sarpras-pages.css">

    <div class="container-fluid py-4">
        <div class="sp">

            {{-- Header --}}
            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ PANEL ADMINISTRATOR</span>
                    <h1 class="sp-title">Kelola <span>Aspirasi</span> &amp; Pengaduan</h1>
                    <p class="sp-lead">Daftar laporan dan aspirasi fasilitas dari siswa.</p>
                </div>
            </header>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="sp-alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup">✕</button>
                </div>
            @endif

            {{-- Tabel Data Aspirasi --}}
            <div class="sp-box sp-tablewrap">
                <table class="sp-table">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th>Kategori</th>
                            <th>Judul Laporan</th>
                            <th>Status</th>
                            <th>Tanggapan</th>
                            <th class="sp-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            @php
                                $status = strtolower($item->status);
                                $kelasStatus = in_array($status, ['selesai', 'proses', 'ditolak']) ? $status : 'pending';
                                $labelStatus = $kelasStatus === 'pending' ? 'Pending' : ucfirst($kelasStatus);
                            @endphp
                            <tr>
                                <td><strong>{{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}</strong></td>
                                <td><span class="sp-tag">{{ $item->kategori->kategori ?? '-' }}</span></td>
                                <td><span class="sp-name">{{ $item->judul }}</span></td>
                                <td><span class="sp-st sp-st--{{ $kelasStatus }}">{{ $labelStatus }}</span></td>
                                <td><span class="sp-muted">{{ $item->tanggapan ?? 'Belum ditanggapi' }}</span></td>
                                <td class="sp-r">
                                    <a href="{{ route('admin.aspirasi.edit', ['id_aspirasi' => $item->id_aspirasi]) }}" class="sp-btn sp-btn--sm sp-btn--amber" title="Tanggapi / Edit">Tanggapi</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="sp-empty">
                                    <h3>Belum Ada Aspirasi / Pengaduan</h3>
                                    <p class="sp-muted">Laporan dari siswa akan muncul di sini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection