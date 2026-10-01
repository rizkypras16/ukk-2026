@php
    // Koneksi database menggunakan PDO standar tanpa ketergantungan framework lama
    $dbConnected = false;
    try {
        $host = 'localhost';
        $dbname = 'db_db_rizky';
        $username = 'root';
        $password = '';
        
        $envPath = __DIR__ . '/../../.env';
        if (file_exists($envPath)) {
            $env = parse_ini_file($envPath);
            $host = $env['DB_HOST'] ?? 'localhost';
            $dbname = $env['DB_DATABASE'] ?? 'db_db_rizky';
            $username = $env['DB_USERNAME'] ?? 'root';
            $password = $env['DB_PASSWORD'] ?? '';
        }

        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }

    // Mengambil data user yang sedang login dengan aman
    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
        ? \App\Models\User::current() 
        : null;
    $userRole = strtolower($currentUser->role ?? '');
@endphp

<!-- Modern Glassmorphism Navbar -->
<nav class="navbar navbar-dark navbar-custom sticky-top py-3">
    <div class="container">
        <!-- Bagian Kiri: Tombol Garis Tiga (Menu Sidebar) & Brand SARPRAS -->
        <div class="d-flex align-items-center gap-3">
            @if ($currentUser)
                <button class="btn-menu-toggle d-flex align-items-center justify-content-center shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Buka Menu Sidebar">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            @endif

            <!-- Status Indikator & Brand SARPRAS -->
            <div class="d-flex align-items-center gap-2 px-3 py-1.5 rounded-pill status-badge" title="{{ $dbConnected ? 'Database Terhubung' : 'Database Terputus' }}">
                <span class="pulse-dot {{ $dbConnected ? 'bg-success' : 'bg-danger' }}"></span>
                <a class="navbar-brand fw-bold m-0 text-white tracking-wide text-decoration-none fs-5" href="{{ route('home') }}">
                    SARPRAS
                </a>
            </div>
        </div>

        <!-- Bagian Kanan: Autentikasi / Profil -->
        <div class="d-flex align-items-center gap-3">
            @if ($currentUser)
                <div class="d-none d-md-flex align-items-center gap-2 user-chip px-3 py-1.5 rounded-pill">
                    <div class="user-avatar-initials">
                        <?= strtoupper(substr($currentUser->username ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="text-start">
                        <span class="d-block text-white fw-semibold small lh-1"><?= htmlspecialchars($currentUser->username) ?></span>
                        <span class="text-muted text-uppercase x-small"><?= htmlspecialchars($currentUser->role) ?></span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger px-3 rounded-pill fw-medium btn-logout-hover">
                        <i class="fas fa-sign-out-alt me-1"></i> Keluar
                    </button>
                </form>
            @else
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-sm btn-link text-white text-decoration-none px-3 fw-medium" href="{{ route('login') }}">Masuk</a>
                    <a class="btn btn-sm btn-gradient px-4 rounded-pill fw-semibold text-white shadow-sm" href="{{ route('register') }}">Daftar Akun</a>
                </div>
            @endif
        </div>
    </div>
</nav>

{{-- Modern Offcanvas Sidebar --}}
@if ($currentUser)
<div class="offcanvas offcanvas-start offcanvas-custom text-white shadow-lg" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header border-bottom border-dark px-4 py-4">
        <div class="d-flex align-items-center gap-3">
            <div class="sidebar-brand-icon">
                <i class="fas fa-boxes text-info"></i>
            </div>
            <div>
                <h5 class="offcanvas-title fw-bold text-white mb-0" id="sidebarMenuLabel">SARPRAS</h5>
                <span class="text-muted small">Manajemen Sarana & Prasarana</span>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column justify-content-between px-3 py-4">
        <ul class="nav nav-pills flex-column gap-1.5">
            <li class="nav-item">
                <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('home') }}">
                    <i class="fas fa-home fa-fw text-secondary"></i>
                    <span>Beranda Utama</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ $userRole === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                    <i class="fas fa-chart-pie fa-fw text-secondary"></i>
                    <span>Halaman Dashboard</span>
                </a>
            </li>

            <!-- Garis Pemisah Menu -->
            <div class="my-2 border-top border-dark opacity-50"></div>

            {{-- MENU KHUSUS ADMIN --}}
            @if ($userRole === 'admin')
                <div class="px-3 pb-1 text-uppercase text-muted x-small fw-bold tracking-wider">Administrator</div>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('kategori.index') }}">
                        <i class="fas fa-tags fa-fw text-primary"></i>
                        <span>Kelola Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('alat.index') }}">
                        <i class="fas fa-boxes fa-fw text-primary"></i>
                        <span>Kelola Alat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('pengguna.index') }}">
                        <i class="fas fa-users-cog fa-fw text-primary"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('admin.pengaduan.index') }}">
                        <i class="fas fa-clipboard-list fa-fw text-primary"></i>
                        <span>Daftar Pengaduan</span>
                    </a>
                </li>
            @endif

            {{-- MENU UNTUK SISWA --}}
            @if ($userRole === 'siswa')
                <div class="px-3 pb-1 text-uppercase text-muted x-small fw-bold tracking-wider">Menu Siswa</div>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('pengaduan.create') }}">
                        <i class="fas fa-plus-circle fa-fw text-success"></i>
                        <span>Buat Pengaduan Baru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white sidebar-item d-flex align-items-center gap-3 px-3 py-2.5" href="{{ route('pengaduan.index') }}">
                        <i class="fas fa-history fa-fw text-success"></i>
                        <span>Riwayat Pengaduan</span>
                    </a>
                </li>
            @endif
        </ul>

        <!-- Info Sesi Pengguna di Bawah Sidebar -->
        <div class="user-card-footer p-3 rounded-4 mt-auto">
            <div class="d-flex align-items-center gap-3">
                <div class="user-avatar-lg">
                    <?= strtoupper(substr($currentUser->username ?? 'U', 0, 1)) ?>
                </div>
                <div class="overflow-hidden">
                    <p class="small text-muted mb-0">Masuk sebagai:</p>
                    <p class="fw-bold mb-0 text-truncate text-white"><?= htmlspecialchars($currentUser->username) ?></p>
                    <span class="badge bg-secondary-subtle text-light x-small mt-1 px-2 py-0.5 rounded-pill"><?= ucfirst($currentUser->role) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    /* Styling Navbar Modern */
    .navbar-custom {
        background: rgba(15, 17, 21, 0.9) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    /* Tombol Garis Tiga (Hamburger Menu) yang Menonjol & Keren */
    .btn-menu-toggle {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.15), rgba(59, 130, 246, 0.15));
        border: 1px solid rgba(56, 189, 248, 0.3);
        color: #38bdf8;
        transition: all 0.25s ease;
    }
    .btn-menu-toggle:hover {
        background: linear-gradient(135deg, #38bdf8, #3b82f6);
        color: #ffffff;
        border-color: transparent;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.4);
    }

    /* Indikator Status Database */
    .status-badge {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse-animation 2s infinite;
    }
    @keyframes pulse-animation {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.6); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(40, 167, 69, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }

    /* User Chip di Navbar */
    .user-chip {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .user-avatar-initials {
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, #6366f1, #3b82f6);
        color: white;
        font-weight: bold;
        font-size: 0.8rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Tombol Gradasi */
    .btn-gradient {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #4338ca 0%, #2563eb 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .btn-logout-hover {
        transition: all 0.2s ease;
    }
    .btn-logout-hover:hover {
        background-color: #dc3545 !important;
        color: white !important;
    }

    /* Offcanvas Sidebar Styling */
    .offcanvas-custom {
        background-color: #0b0d10 !important;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        max-width: 300px;
    }
    .sidebar-brand-icon {
        width: 40px;
        height: 40px;
        background: rgba(56, 189, 248, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(56, 189, 248, 0.2);
    }

    /* Item Sidebar Hover Efek */
    .sidebar-item {
        border-radius: 10px;
        transition: all 0.2s ease;
        font-size: 0.92rem;
        color: #94a3b8 !important;
    }
    .sidebar-item:hover {
        background-color: rgba(255, 255, 255, 0.06) !important;
        color: #ffffff !important;
        transform: translateX(4px);
    }
    .sidebar-item.active {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.2), rgba(59, 130, 246, 0.2)) !important;
        color: #ffffff !important;
        border: 1px solid rgba(99, 102, 241, 0.3);
    }

    /* Footer di dalam Sidebar */
    .user-card-footer {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    .user-avatar-lg {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        color: white;
        font-weight: bold;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .x-small { font-size: 0.75rem; }
    .tracking-wide { letter-spacing: 0.5px; }
    .tracking-wider { letter-spacing: 1px; }
</style>