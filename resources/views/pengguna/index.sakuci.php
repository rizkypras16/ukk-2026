@extends('layouts.app')

@section('title', config('app.name') . ' -- Data Pengguna')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
   

    <div class="container py-4">
        <div class="sp">

            {{-- Header Halaman --}}
            <header class="sp-pagehead">
                <div>
                    <span class="sp-sticker">★ MANAJEMEN SISTEM</span>
                    <h1 class="sp-title">Data <span>Pengguna</span></h1>
                    <p class="sp-lead">Kelola data siswa beserta akun loginnya.</p>
                </div>
                <a href="{{ route('admin.pengguna.create') }}" class="sp-btn">+ Tambah Pengguna</a>
            </header>

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
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Username</th>
                                <th class="sp-r">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td><strong>{{ method_exists($data, 'firstItem') ? $data->firstItem() + $index : $index + 1 }}</strong></td>
                                    <td><span class="sp-code">{{ $item->nis }}</span></td>
                                    <td><span class="sp-name">{{ $item->nama }}</span></td>
                                    <td><span class="sp-tag">{{ $item->kelas }}</span></td>
                                    <td><span class="sp-muted">{{ $item->username ?? '-' }}</span></td>
                                    <td class="sp-r">
                                        <div class="sp-actions">
                                            <a href="{{ route('admin.pengguna.edit', ['pengguna' => $item->id_siswa]) }}" class="sp-btn sp-btn--sm sp-btn--amber">Edit</a>

                                            <form action="{{ route('admin.pengguna.destroy', ['pengguna' => $item->id_siswa]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini beserta akunnya?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="sp-btn sp-btn--sm sp-btn--coral">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="sp-empty">
                                        <h3>Belum ada data pengguna</h3>
                                        <p class="sp-muted">Tambahkan siswa baru melalui tombol di atas.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($data, 'hasPages') && $data->hasPages())
                    <div class="sp-pager">
                        {!! $data->links('pagination::bootstrap-5') !!}
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection