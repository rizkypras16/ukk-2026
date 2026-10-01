@extends('layouts.app')

@section('title', 'Masuk - Sakuci')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" style="background-color: #0d1117;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <!-- Alert Demo -->
                <div class="alert alert-dark border border-secondary border-opacity-25 text-light mb-3 rounded-3 p-3">
                    <span class="d-block fw-bold text-info mb-1 small">AKUN DEMO:</span>
                    <span class="text-muted small">Admin:</span> <code class="text-light">admin</code> / <code class="text-light">rahasia123</code><br>
                    <span class="text-muted small">Nis Anda</span> <code class="text-light">nis anda</code> / <code class="text-light">siswa123</code>
                </div>

                <!-- Card Login -->
                <div class="card bg-dark text-light border border-secondary border-opacity-25 rounded-3 shadow">
                    <div class="card-body p-4 p-sm-4">
                        
                        <div class="mb-4">
                            <h4 class="fw-bold mb-1">Masuk</h4>
                            <p class="text-muted small">Masukkan akun Sakuci Anda</p>
                        </div>

                        <form method="POST" action="{{ route('login.attempt') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted small">NIS</label>
                                <input type="text" name="username" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small">Password</label>
                                <input type="password" name="password" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fw-semibold py-2 rounded-2 mt-2">Masuk</button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top border-secondary border-opacity-25">
                            <span class="text-muted small">Belum punya akun? </span>
                            <a href="{{ route('register') }}" class="text-info text-decoration-none small fw-semibold">Daftar sekarang</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection