@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
    $currentUser = \App\Models\User::current();
@endphp

<!-- Topbar Header (Warna Solid Gelap) -->
<nav class="navbar navbar-dark bg-dark-solid border-bottom border-secondary sticky-top py-2">
    <div class="container">
        <div class="d-flex align-items-center gap-2">
            {{-- Tombol Toggle Sidebar (HANYA MUNCUL JIKA USER LOGIN) --}}
            @if ($currentUser)
                <button class="btn btn-outline-light btn-sm me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Buka Menu">
                    Menu
                </button>
            @endif

            {{-- Indikator Database / Toggle Tema --}}
            <button id="themeToggle" type="button" class="logo-toggle border-0 bg-transparent p-0"
                    aria-label="Ganti tema terang/gelap (status database: {{ $dbConnected ? 'terhubung' : 'tidak terhubung' }})"
                    title="Ganti tema terang/gelap">
                <svg width="24" height="24" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;" aria-hidden="true">
                    <circle class="logo-ring" cx="16" cy="16" r="15"/>
                    <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
                </svg>
            </button>

            <a class="navbar-brand fw-semibold m-0 text-white" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>

        {{-- Area Kanan: Status Login / Tombol Masuk --}}
        <div class="d-flex align-items-center gap-2">
            @if ($currentUser)
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Logout ({{ $currentUser->username }})</button>
                </form>
            @else
                @php
                    $canRegister = false;
                    if ($dbConnected) {
                        try {
                            $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                        } catch (\Throwable $e) {
                            $canRegister = false;
                        }
                    }
                @endphp

                @if ($canRegister)
                    <a class="btn btn-sm btn-outline-light me-1" href="{{ route('register') }}">Daftar</a>
                @endif

                <a class="btn btn-sm btn-primary rounded-pill px-3 d-inline-flex align-items-center gap-2" href="{{ route('login') }}">
                    Masuk
                </a>
            @endif
        </div>
    </div>
</nav>

{{-- Sidebar Offcanvas Kiri (HANYA MUNCUL & DIBUAT JIKA USER LOGIN) --}}
@if ($currentUser)
<div class="offcanvas offcanvas-start bg-dark-solid text-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="max-width: 280px;">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title fw-bold text-white" id="sidebarMenuLabel">
            Navigasi
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
        <ul class="nav nav-pills flex-column gap-2">
            <li class="nav-item">
                <a class="nav-link text-white sidebar-item {{ is_route('home') ? 'active-sidebar' : '' }}" href="{{ route('home') }}">
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white sidebar-item {{ is_route('kategori.index', 'admin.kategori.index') ? 'active-sidebar' : '' }}" href="{{ route('kategori.index') }}">
                    Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white sidebar-item {{ is_route('alat.index', 'admin.alat.index') ? 'active-sidebar' : '' }}" href="{{ route('alat.index') }}">
                    Alat
                </a>
            </li>

            @if ($currentUser->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item {{ is_route('admin.pengguna.index', 'pengguna.index') ? 'active-sidebar' : '' }}" href="{{ route('admin.pengguna.index') }}">
                        Pengguna
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link text-white sidebar-item {{ is_route('admin.dashboard', 'dashboard') ? 'active-sidebar' : '' }}" href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                    Dashboard
                </a>
            </li>
        </ul>

        {{-- Info Pengguna di Bagian Bawah Sidebar --}}
        <div class="pt-3 border-top border-secondary">
            <p class="small text-secondary mb-1">Login sebagai:</p>
            <p class="fw-bold mb-0 text-truncate text-white">{{ $currentUser->username }} ({{ ucfirst($currentUser->role) }})</p>
        </div>
    </div>
</div>
@endif

{{-- Styling Warna Solid Tanpa Gradien --}}
<style>
    .bg-dark-solid {
        background-color: #121212 !important;
    }

    .border-secondary {
        border-color: #2d2d2d !important;
    }

    .sidebar-item {
        border-radius: 8px;
        transition: all 0.2s ease;
        padding: 10px 14px;
    }

    .sidebar-item:hover {
        background-color: #1e1e1e;
        color: #0d6efd !important;
    }

    .active-sidebar {
        background-color: #0d6efd !important;
        color: #ffffff !important;
    }
</style>