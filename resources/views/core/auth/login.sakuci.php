@extends('layouts.app')

@section('title', 'Masuk - Sakuci')

@section('content')
<div class="auth-page py-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">

            <span class="nb-sticker">★ AKSES SISTEM</span>
            <h1 class="mt-3 mb-2">Masuk ke <span>Sakuci</span></h1>
            <p class="mb-4">Masukkan akun Sakuci Anda untuk melanjutkan.</p>

            <!-- Akun Demo -->
            <div class="alert alert-info mb-4">
                <span class="d-block mb-1">AKUN DEMO</span>
                Admin: <code>admin</code> / <code>rahasia123</code><br>
                Siswa: <code>NIS anda</code> / <code>siswa123</code>
            </div>

            <!-- Card Login -->
            <div class="card">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login.attempt') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>

                    <div class="text-center mt-4 pt-3 nb-divider">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="nb-link">Daftar sekarang</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection