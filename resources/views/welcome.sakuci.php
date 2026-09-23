@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Style Tambahan untuk Tema Hitam-Putih Modern --}}
    <style>
        /* Variabel Warna Utama - Monokrom & Aksen Modern */
        :root {
            --dark-bg: #121212;
            --card-dark: #1e1e1e;
            --text-primary: #f8f9fa;
            --text-secondary: #a0a0a0;
            --accent-color: #0d6efd; /* Biru/Teal profesional yang pas untuk tema gelap/terang */
            --accent-hover: #0b5ed7;
            --border-color: #2d2d2d;
        }

        /* Hero Section Container */
        .hero-section {
            background: linear-gradient(180deg, rgba(255,255,255,0.02) 0%, rgba(0,0,0,0.05) 100%);
            border-radius: 16px;
            padding: 3rem 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        /* Badge Custom */
        .badge-brand-custom {
            background-color: #2b2b2b;
            color: #e0e0e0;
            border: 1px solid #404040;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* Typography Hilights */
        .text-brand-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Tombol Custom */
        .btn-brand-custom {
            background-color: #0d6efd;
            color: #ffffff;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(13, 110, 253, 0.3);
        }

        .btn-brand-custom:hover {
            background-color: #0b5ed7;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        }

        .btn-outline-custom {
            border: 1px solid #404040;
            color: #d0d0d0;
            background-color: rgba(255, 255, 255, 0.03);
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            border-color: #0d6efd;
            color: #0d6efd;
            background-color: rgba(13, 110, 253, 0.05);
            transform: translateY(-2px);
        }

        /* Code Tag Custom */
        code.inline-custom {
            background-color: rgba(255, 255, 255, 0.08);
            color: #0dcaf0;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5 hero-section my-3">
        <span class="badge rounded-pill badge-brand-custom px-3 py-2 mb-3">Sakuci v1.0.0</span>

        <h1 class="display-5 fw-bold mb-3">
            PENGADUAN SARANA & PRASARANA<br class="d-none d-md-inline">
            <span class="text-brand-custom">SMK SANGKURIANG 1 CIMAHI</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            Laporkan kerusakan atau kendala fasilitas sekolah dengan cepat, praktis,
            dan tertransparansi
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand-custom btn-lg px-4" href="{{ route('kategori.index') }}">mulai laporkan</a>
            <a class="btn btn-outline-custom btn-lg px-4" href="https://github.com/indrabsus/sakuci-framework" target="_blank">GitHub</a>
        </div>

        <p class="text-secondary small mt-4 mb-0">
            Panduan langkah demi langkah cara melapor
            <code class="inline-custom">TUTORIAL.md</code>
        </p>
    </section>

@endsection