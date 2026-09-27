@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
    $currentUser = \App\Models\User::current();
    $userRole = strtolower($currentUser->role ?? '');
@endphp

<!-- Topbar Header -->
<nav class="navbar navbar-dark bg-dark-solid border-bottom border-secondary sticky-top py-2">
    <div class="container">
        <div class="d-flex align-items-center gap-2">
            @if ($currentUser)
                <button class="btn btn-outline-primary btn-sm me-1 text-white border-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Buka Menu">
                    Menu
                </button>
            @endif

            <button id="themeToggle" type="button" class="logo-toggle border-0 bg-transparent p-0" title="Ganti tema">
                <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;">
                    <circle class="logo-ring" cx="16" cy="16" r="15"/>
                    <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
                </svg>
            </button>

            <a class="navbar-brand fw-semibold m-0 text-white" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>

        <div class="d-flex align-items-center gap-2">
            @if ($currentUser)
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Logout ({{ $currentUser->username }})</button>
                </form>
            @else
                <a class="btn btn-sm btn-outline-light rounded-pill px-3" href="{{ route('login') }}">Masuk</a>
                <a class="btn btn-sm btn-primary rounded-pill px-3" href="{{ route('register') }}">Daftar</a>
            @endif
        </div>
    </div>
</nav>

{{-- Sidebar Offcanvas Kiri --}}
@if ($currentUser)
<div class="offcanvas offcanvas-start bg-dark-solid text-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="max-width: 280px;">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title fw-bold text-white" id="sidebarMenuLabel">Navigasi</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
        <ul class="nav nav-pills flex-column gap-2">
            <li class="nav-item">
                <a class="nav-link text-white sidebar-item" href="{{ route('home') }}">
                    Beranda
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white sidebar-item" href="{{ $userRole === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                    Dashboard
                </a>
            </li>

            {{-- MENU KHUSUS ADMIN --}}
            @if ($userRole === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item" href="{{ route('kategori.index') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item" href="{{ route('alat.index') }}">Alat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item" href="{{ route('pengguna.index') }}">Pengguna</a>
                </li>
            @endif

            {{-- MENU UNTUK SISWA --}}
            @if ($userRole === 'siswa')
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item" href="{{ route('pengaduan.index') }}">Pengaduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item" href="{{ route('pengaduan.create') }}">Buat Pengaduan</a>
                </li>
            @endif
        </ul>

        {{-- Info Pengguna di Bagian Bawah Sidebar --}}
        <div class="pt-3 border-top border-secondary">
            <p class="small text-secondary mb-1">Login sebagai:</p>
            <p class="fw-bold mb-0 text-truncate text-white">{{ $currentUser->username }} ({{ ucfirst($currentUser->role) }})</p>
        </div>
    </div>
</div>
@endif

<style>
    .bg-dark-solid { background-color: #121212 !important; }
    .border-secondary { border-color: #2d2d2d !important; }
    
    /* Styling Item Sidebar & Warna Biru Khas Sakuci */
    .sidebar-item { 
        border-radius: 8px; 
        transition: all 0.2s ease; 
        padding: 10px 14px; 
    }
    .sidebar-item:hover { 
        background-color: #0d6efd !important; 
        color: #ffffff !important; 
    }
    
    /* Tombol Utama Biru */
    .btn-primary { 
        background-color: #0d6efd !important; 
        border-color: #0d6efd !important; 
    }
    .btn-primary:hover { 
        background-color: #0b5ed7 !important; 
        border-color: #0a58ca !important; 
    }
    
    /* Indikator Aktif Berwarna Biru */
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link, .sidebar-item.active { 
        background-color: #0d6efd !important; 
        color: #ffffff !important; 
    }
</style>