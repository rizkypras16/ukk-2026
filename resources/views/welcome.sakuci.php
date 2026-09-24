@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Style Tambahan untuk Tema Modern & Premium --}}
    <style>
        :root {
            --dark-bg: #121212;
            --card-dark: #1a1d20;
            --accent-blue: #0d6efd;
            --accent-cyan: #0dcaf0;
            --border-glow: rgba(13, 202, 240, 0.2);
        }

        /* Hero Container */
        .hero-section {
            background: radial-gradient(circle at top, rgba(13, 110, 253, 0.15) 0%, rgba(18, 18, 18, 0) 70%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 3.5rem 1.5rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .badge-brand-custom {
            background: rgba(13, 110, 253, 0.15);
            color: #6ea8fe;
            border: 1px solid rgba(13, 110, 253, 0.3);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .text-brand-custom {
            background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Tombol Modern */
        .btn-brand-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: #ffffff;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        }

        .btn-brand-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.6);
            color: #fff;
        }

        .btn-outline-custom {
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #e0e0e0;
            background: rgba(255, 255, 255, 0.03);
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            border-color: #0dcaf0;
            color: #0dcaf0;
            background: rgba(13, 202, 240, 0.05);
            transform: translateY(-2px);
        }

        code.inline-custom {
            background-color: rgba(255, 255, 255, 0.08);
            color: #0dcaf0;
            padding: 3px 8px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Card Panduan / Step Card */
        .step-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            height: 100%;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(13, 202, 240, 0.3);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .step-card:hover::before {
            opacity: 1;
        }

        /* Lingkaran Nomor / Badge Step */
        .step-badge {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.2) 0%, rgba(13, 202, 240, 0.2) 100%);
            border: 1px solid rgba(13, 202, 240, 0.3);
            color: #0dcaf0;
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem auto;
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

    {{-- Section Alur Pengaduan --}}
    <section class="py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white mb-2">Prosedur Pengaduan</h2>
            <p class="text-secondary">4 langkah mudah menyampaikan laporan fasilitas sekolah</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Langkah 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="step-card text-center">
                    <div class="step-badge">01</div>
                    <h5 class="fw-bold text-white mb-2">Akses Layanan</h5>
                    <p class="text-secondary small mb-0">
                        Klik tombol <span class="text-white fw-semibold">"mulai laporkan"</span> pada halaman utama untuk menuju formulir.
                    </p>
                </div>
            </div>

            <!-- Langkah 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="step-card text-center">
                    <div class="step-badge">02</div>
                    <h5 class="fw-bold text-white mb-2">Isi Data Rinci</h5>
                    <p class="text-secondary small mb-0">
                        Lengkapi identitas diri, lokasi sarana, dan detail kerusakan fasilitas yang dilaporkan.
                    </p>
                </div>
            </div>

            <!-- Langkah 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="step-card text-center">
                    <div class="step-badge">03</div>
                    <h5 class="fw-bold text-white mb-2">Kirim Laporan</h5>
                    <p class="text-secondary small mb-0">
                        Periksa kembali kelengkapan data lalu tekan kirim agar tersimpan di sistem.
                    </p>
                </div>
            </div>

            <!-- Langkah 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="step-card text-center">
                    <div class="step-badge">04</div>
                    <h5 class="fw-bold text-white mb-2">Tindak Lanjut</h5>
                    <p class="text-secondary small mb-0">
                        Tim sarana prasarana sekolah akan memverifikasi dan memperbaiki kerusakan.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection