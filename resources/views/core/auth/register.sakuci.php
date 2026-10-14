@extends('layouts.app')

@section('title', 'Daftar - Sakuci')

@section('content')
<div class="auth-page py-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">

            <span class="nb-sticker">★ AKUN BARU</span>
            <h1 class="mt-3 mb-2">Daftar <span>Siswa</span></h1>
            <p class="mb-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="nb-link">Masuk</a>
            </p>

            <div class="card">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.attempt') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII RPL 3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Daftar Akun</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection