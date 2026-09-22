@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Sakuci v1.0.0</span>

        <h1 class="display-5 fw-bold mb-3">
            PENGADUAN SARANA & PRASARANA<br class="d-none d-md-inline">
            <span class="text-brand">SMK SANGKURIANG 1 CIMAHI</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            Laporkan kerusakan atau kendala fasilitas sekolah dengan cepat, praktis,
            dan tertransparansi
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('kategori.index') }}">mulai laporkan</a>
            <a class="btn btn-outline-brand btn-lg px-4" href="https://github.com/indrabsus/sakuci-framework" target="_blank">GitHub</a>
        </div>

        <p class="text-secondary small mt-3 mb-0">
            Panduan langkah demi langkah cara melapor
            <code class="inline">TUTORIAL.md</code>
        </p>
    </section>

    
@endsection
