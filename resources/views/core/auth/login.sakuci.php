@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h1 class="h4 mb-1 font-weight-bold">Masuk</h1>
                    <p class="text-secondary small mb-4">Silakan masuk menggunakan akun Anda.</p>

                    <form method="POST" action="{{ route('login.attempt') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="username">Username / NIS</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}" placeholder="Masukkan username" autofocus>
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button class="btn btn-brand w-100 py-2 font-weight-semibold" type="submit">Login</button>
                    </form>

                    {{-- Tombol Registrasi (Dipaksa Muncul) --}}
                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-secondary small mb-2">Belum memiliki akun siswa?</p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill py-2 fw-semibold">
                            Daftar Akun Baru
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection