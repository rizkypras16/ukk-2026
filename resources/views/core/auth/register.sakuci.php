@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-1">Daftar Akun Siswa</h4>
                    <p class="text-muted small mb-4">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('register.attempt') }}" method="POST">
                        @csrf

                        {{-- Kirim role 'siswa' secara tersembunyi agar lolos validasi role --}}
                        <input type="hidden" name="role" value="siswa">

                        <div class="mb-3">
                            <label class="form-label">NIS (Nomor Induk Siswa)</label>
                            {{-- Input NIS dikirim sebagai username & nis --}}
                            <input type="text" name="username" class="form-control" placeholder="Masukkan NIS" value="{{ old('username') }}" required>
                            <input type="hidden" name="nis" value="{{ old('username') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII RPL 3" value="{{ old('kelas') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password min 6 karakter" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Daftar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Menyinkronkan nilai username ke field NIS secara otomatis
    document.querySelector('input[name="username"]').addEventListener('input', function() {
        document.querySelector('input[name="nis"]').value = this.value;
    });
</script>
@endsection