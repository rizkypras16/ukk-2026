@extends('layouts.app')

@section('title', 'Dashboard Siswa - Sakuci')

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">

    <div class="container">
        <div class="sp">

            <header class="sp-hero" style="grid-template-columns:1fr auto;padding:36px 0 10px">
                <div>
                    <span class="sp-sticker">★ DASHBOARD SISWA</span>
                    <h1 class="sp-title" style="font-size:clamp(2rem,5vw,3.6rem)">HALO, <span>{{ $siswa->nama ?? $user->username }}</span></h1>
                    <p class="sp-lead">Lihat daftar alat dan sampaikan aspirasi atau laporanmu dengan mudah.</p>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="sp-btn sp-btn--white">Logout</button>
                </form>
            </header>

            <section class="sp-sec" style="padding-top:30px">
                <h2 class="sp-head">Yang bisa <mark>kamu lakukan</mark>.</h2>
                <div class="sp-grid">
                    <a class="sp-box sp-feat" href="/aspirasi/create"><h3>Buat Aspirasi</h3><p>Kirim laporan atau aspirasi baru.</p></a>
                    <a class="sp-box sp-feat" href="/aspirasi"><h3>Aspirasi Saya</h3><p>Pantau status laporan yang sudah dikirim.</p></a>
                    <a class="sp-box sp-feat" href="/alat"><h3>Daftar Alat</h3><p>Lihat alat dan fasilitas sekolah.</p></a>
                </div>
            </section>

        </div>
    </div>

@endsection