@extends('layouts.app')

@section('title', config('app.name') . ' -- Aplikasi Pengaduan Sarpras UKK RPL')

@section('content')

    <style>
        :root {
            --dark-bg: #080c14;
            --card-dark: #0f172a;
            --accent-blue: #3b82f6;
            --accent-cyan: #06b6d4;
        }

        .hero-section {
            position: relative;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(8, 12, 20, 1) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 4.5rem 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            overflow: hidden;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .text-brand-custom {
            color: #38bdf8;
            font-weight: 800;
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.3);
        }

        .btn-brand-custom {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            border: none;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s ease;
            padding: 0.8rem 2rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235,.3);
        }

        .btn-brand-custom:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-login-custom {
            border: 1px solid rgba(56, 189, 248, 0.4);
            color: #38bdf8;
            background: rgba(56, 189, 248, 0.03);
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s ease;
            padding: 0.8rem 2rem;
        }

        .btn-login-custom:hover {
            background: rgba(56, 189, 248, 0.1);
            color: #ffffff;
            border-color: #38bdf8;
            transform: translateY(-2px);
        }

        /* --- DESAIN ELEGAN & MEWAH TANPA ANIMASI --- */
        .teacher-container {
            position: relative;
            width: 100%;
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .teacher-avatar-wrapper {
            width: 140px;
            height: 140px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: 2px solid rgba(56, 189, 248, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.7), 0 0 30px rgba(56, 189, 248, 0.15);
            position: relative;
            z-index: 2;
            overflow: hidden;
        }

        .teacher-avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .speech-bubble {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.95), rgba(15, 23, 42, 0.98));
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 0.85rem 1.15rem;
            border-radius: 16px;
            font-size: 0.85rem;
            color: #e2e8f0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            max-width: 210px;
            z-index: 3;
            backdrop-filter: blur(8px);
        }

        .speech-bubble::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 30px;
            border-width: 8px 8px 0;
            border-style: solid;
            border-color: rgba(30, 41, 59, 0.95) transparent;
            display: block;
            width: 0;
        }

        .teacher-badge {
            position: absolute;
            bottom: 12px;
            background: rgba(6, 182, 212, 0.12);
            border: 1px solid rgba(6, 182, 212, 0.3);
            color: #38bdf8;
            font-size: 0.75rem;
            padding: 0.3rem 0.85rem;
            border-radius: 20px;
            font-weight: 600;
            z-index: 3;
            backdrop-filter: blur(4px);
        }

        .procedure-box {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.7), rgba(11, 17, 32, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="container">
        {{-- Hero Section Utama --}}
        <section class="hero-section">
            <div class="row align-items-center g-5">
                
                {{-- KOLOM KIRI: Judul & Tombol Aksi --}}
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="text-secondary small fw-semibold text-uppercase tracking-widest d-block mb-2" style="letter-spacing: 2px;">
                        UKK RPL -- Uji Kompetensi Keahlian
                    </span>

                    <h1 class="display-5 fw-bold mb-3 text-white" style="letter-spacing: -0.5px;">
                        Pengaduan Sarana & Prasarana <span class="text-brand-custom">Sakuci</span>
                    </h1>

                    <p class="text-secondary mb-4" style="font-size: 1rem; line-height: 1.7;">
                        Platform digital resmi untuk pelaporan, pengelolaan, dan pemantauan perbaikan fasilitas atau alat sekolah secara cepat, transparan, dan terstruktur.
                    </p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <a class="btn btn-brand-custom shadow" href="{{ route('pengaduan.create') }}">
                            <i class="bi bi-megaphone-fill me-2"></i> Buat Pengaduan
                        </a>
                        <a class="btn btn-login-custom shadow-sm" href="/login">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Masuk Sistem
                        </a>
                    </div>
                </div>

                {{-- KOLOM KANAN: Karakter Ilustrasi & Panduan Singkat --}}
                <div class="col-lg-6">
                    <div class="procedure-box">
                        <div class="row align-items-center">
                            
                            {{-- Foto Ilustrasi Karakter --}}
                            <div class="col-md-5">
                                <div class="teacher-container">
                                    <div class="speech-bubble">
                                        <i class="bi bi-chat-left-text-fill text-info me-1"></i> Halo! Ada alat atau fasilitas rusak? Lapor yuk!
                                    </div>
                                    <div class="teacher-avatar-wrapper">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=RizkyPras&backgroundColor=b6e3f4,c0aede,d1d4f9" alt="Admin Sarpras">
                                    </div>
                                    <div class="teacher-badge">
                                        <i class="bi bi-circle-fill text-success" style="font-size: 6px;"></i> Layanan Aktif
                                    </div>
                                </div>
                            </div>

                            {{-- Teks Panduan --}}
                            <div class="col-md-7">
                                <h6 class="fw-bold text-white mb-3" style="letter-spacing: 0.5px;">
                                    <i class="bi bi-shield-check text-info me-2"></i> Alur Layanan
                                </h6>
                                <ul class="list-unstyled text-secondary small mb-0" style="line-height: 1.9;">
                                    <li class="mb-2"><strong class="text-white">1.</strong> Login akun siswa.</li>
                                    <li class="mb-2"><strong class="text-white">2.</strong> Pilih alat & isi keluhan.</li>
                                    <li class="mb-2"><strong class="text-white">3.</strong> Kirim laporan kerusakan.</li>
                                    <li><strong class="text-white">4.</strong> Pantau proses perbaikan.</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection