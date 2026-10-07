@extends('layouts.app')

@section('title', config('app.name') . ' -- Data Kategori Sarpras')

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
                    <h1 class="sp-title">Data <span>Kategori</span></h1>
                </div>
                <a href="{{ route('kategori.create') }}" class="sp-btn">+ Tambah Kategori</a>
            </header>

            @if(session('success'))
                <div class="sp-alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup">✕</button>
                </div>
            @endif

            {{-- Tabel Data --}}
            <div class="sp-box sp-tablewrap">
                <table class="sp-table">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th class="sp-c">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td><strong>{{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}</strong></td>
                                <td><span class="sp-code">{{ 'KTG' . sprintf('%03d', $item->id_kategori) }}</span></td>
                                <td><span class="sp-name">{{ $item->kategori ?? '-' }}</span></td>
                                <td class="sp-c">
                                    <div class="sp-actions">
                                        <a href="{{ route('admin.kategori.edit', [$item->id_kategori]) }}" class="sp-btn sp-btn--sm sp-btn--amber">Edit</a>

                                        <form action="{{ route('admin.kategori.destroy', [$item->id_kategori]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="sp-btn sp-btn--sm sp-btn--coral">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="sp-empty">
                                    <h3>Belum ada data kategori</h3>
                                    <p class="sp-muted">Data kategori yang tersedia akan muncul di sini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if(method_exists($data, 'hasPages') && $data->hasPages())
                    <div class="sp-pager">
                        {!! $data->links('pagination::bootstrap-5') !!}
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection