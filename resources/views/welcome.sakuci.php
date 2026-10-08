@extends('layouts.app')

@section('title', config('app.name') . ' -- Sistem Informasi Sarana Prasarana')

@section('content')

    {{-- Aset landing page (CSS & JS dipisah dari view) --}}
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sarpras-landing.css">

    <div class="container">
        <div class="sp">

            {{-- HERO --}}
            <header class="sp-hero">
                <div>
                    <span class="sp-sticker">★SMK SANGKURIANG 1</span>
                    <h1 class="sp-title">ASET SEKOLAH <span>RAPI</span> <b>&amp;</b> TERPANTAU.</h1>
                    <p class="sp-lead">Inventaris, perawatan, dan pengadaan barang dalam satu sistem. Nggak ada lagi catatan yang hilang atau barang yang lupa diperbaiki.</p>
                    <div class="sp-cta">
                        <a class="sp-btn" href="/login">Mulai Kelola</a>
                        <a class="sp-btn sp-btn--white" href="#sp-fitur">Lihat Fitur</a>
                    </div>
                </div>

                <div class="sp-box sp-panel">
                    <h3>COBA LANGSUNG</h3>
                    <small>Klik barang untuk ganti kondisinya</small>
                    <div id="sp-list"></div>
                    <div class="sp-sum" id="sp-sum"></div>
                </div>
            </header>

            {{-- FITUR --}}
            <section class="sp-sec" id="sp-fitur">
                <h2 class="sp-head">Semua urusan <mark>sarpras</mark>, satu tempat.</h2>
                <div class="sp-grid">
                    <div class="sp-box sp-feat"><h3>Inventaris</h3><p>Barang tercatat per ruangan dan kategori dengan kondisi terbaru.</p></div>
                    <div class="sp-box sp-feat"><h3>Pemeliharaan</h3><p>Riwayat dan jadwal perawatan tidak lagi terlewat.</p></div>
                    <div class="sp-box sp-feat"><h3>Pengadaan</h3><p>Ajukan barang baru dan pantau tiap tahap persetujuannya.</p></div>
                    <div class="sp-box sp-feat"><h3>Notifikasi</h3><p>Kabar penting langsung muncul untuk yang berkepentingan.</p></div>
                    <div class="sp-box sp-feat"><h3>Dashboard</h3><p>Ringkasan kondisi aset terlihat sekali pandang.</p></div>
                    <div class="sp-box sp-feat"><h3>Hak Akses</h3><p>Admin dan petugas hanya melihat yang memang tugasnya.</p></div>
                </div>
            </section>

            {{-- PERAN --}}
            <section class="sp-sec">
                <h2 class="sp-head">siapa <mark>kamu?</mark>.</h2>
                <div class="sp-tabs">
                    <button type="button" class="sp-tab is-on" data-role="admin">Admin</button>
                    <button type="button" class="sp-tab" data-role="petugas">Siswa</button>
                </div>
                <div class="sp-box sp-role">
                    <div>
                        <h3 id="sp-role-title">ADMIN</h3>
                        <p id="sp-role-desc" style="margin-top:12px"></p>
                    </div>
                    <ul id="sp-role-list"></ul>
                </div>
            </section>

            {{-- ALUR --}}
            <section class="sp-sec">
                <h2 class="sp-head">Cuma <mark>4 langkah</mark>.</h2>
                <div class="sp-flow">
                    <div class="sp-box sp-step"><b style="background:var(--lime)">1</b><h3>Masuk</h3><p>Login sesuai peran.</p></div>
                    <div class="sp-box sp-step"><b style="background:var(--sky)">2</b><h3>Catat</h3><p>Input barang & kondisi.</p></div>
                    <div class="sp-box sp-step"><b style="background:var(--coral)">3</b><h3>Ajukan</h3><p>Pengadaan atau perawatan.</p></div>
                    <div class="sp-box sp-step"><b style="background:var(--violet)">4</b><h3>Pantau</h3><p>Lihat status di dashboard.</p></div>
                </div>
            </section>

            {{-- PENUTUP --}}
            <div class="sp-box sp-end">
                <h2>SIAP RAPIKAN SARPRAS?</h2>
                <a class="sp-btn sp-btn--dark" href="/login">Masuk ke Sistem →</a>
            </div>

        </div>
    </div>

    <script src="/js/sarpras-landing.js"></script>

@endsection