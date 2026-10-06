@extends('layouts.app')

@section('title', 'Dashboard Admin - Sakuci')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">

    <div class="container">
        <div class="sp">

            <header class="sp-hero" style="grid-template-columns:1fr auto;padding:36px 0 10px">
                <div>
                    <span class="sp-sticker">★ DASHBOARD ADMIN</span>
                    <h1 class="sp-title" style="font-size:clamp(2rem,5vw,3.6rem)">HALO, <span>{{ $user->username }}</span></h1>
                    <p class="sp-lead">Kelola data sekolah, pantau aspirasi, dan atur akun pengguna dari sini.</p>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="sp-btn sp-btn--white">Logout</button>
                </form>
            </header>

            <section class="sp-sec" style="padding-top:30px">
                <h2 class="sp-head">Menu <mark>pengelolaan</mark>.</h2>
                <div class="sp-grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr))">
                    <a class="sp-box sp-feat" href="/admin/pengguna"><h3>Pengguna</h3><p>Kelola data siswa dan akun pengguna.</p></a>
                    <a class="sp-box sp-feat" href="/alat"><h3>Alat</h3><p>Lihat dan kelola daftar alat sekolah.</p></a>
                    <a class="sp-box sp-feat" href="/kategori"><h3>Kategori</h3><p>Atur kategori alat atau barang.</p></a>
                    <a class="sp-box sp-feat" href="/admin/aspirasi"><h3>Aspirasi</h3><p>Tinjau dan tindak lanjuti laporan masuk.</p></a>
                </div>
            </section>

            <div style="margin-top:40px">
                <a class="sp-btn" href="/admin/database/export">Ekspor Database</a>
                <a class="sp-btn sp-btn--white" href="/" style="margin-left:10px">Lihat Landing Page</a>
            </div>

        </div>
    </div>

@endsection