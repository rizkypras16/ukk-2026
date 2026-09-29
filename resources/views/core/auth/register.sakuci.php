@extends('layouts.app')

@section('title', 'Daftar - Sakuci')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" style="background-color: #0d1117;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card bg-dark text-light border border-secondary border-opacity-25 rounded-3 shadow">
                    <div class="card-body p-4 p-sm-4">
                        
                        <div class="mb-4">
                            <h4 class="fw-bold mb-1">Pendaftaran Siswa</h4>
                            <p class="text-muted small">Sudah punya akun? <a href="{{ route('login') }}" class="text-info text-decoration-none">Masuk</a></p>
                        </div>

                        <form method="POST" action="{{ route('register.attempt') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label text-muted small">NIS</label>
                                <input type="text" name="nis" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Kelas</label>
                                <input type="text" name="kelas" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" placeholder="Contoh: XII RPL 3" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small">Password</label>
                                <input type="password" name="password" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control bg-black text-light border-secondary border-opacity-50 rounded-2" required>
                            </div>

                            <button type="submit" class="btn btn-light text-dark w-100 fw-semibold py-2 rounded-2">Daftar Akun</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection