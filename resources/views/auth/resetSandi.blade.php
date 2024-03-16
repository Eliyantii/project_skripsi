@extends('auth.layouts.utama')

@section('content')
<div class="row g-2 d-flex justify-content-between align-items-center">
    <div class="col-6">
        <img src="/assets/Poster_Daftar.png" alt="" class="img-fluid">
    </div>  
    <div class="col-6 justify-center align-content-center">
        <div class="mx-3 my-3 border border-2 border-secondary rounded bg-white p-3">
            <h1 class="text-center fw-bold mb-3">Reset Kata Sandi</h1>
            @if (session()->has('error'))
                <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="mx-3 alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }} <a href="/karuniamotor/login">Login</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/karuniamotor/forgot-password/reset-password/{{ $userId }}" method="POST" autocomplete="off">
                @csrf
                <div class="my-5 px-3">
                    <div class="mb-3">
                        <input type="hidden" name="userId" value="{{ $userId }}">
                        <label for="password" class="form-label fw-semibold mb-0 pb-0">Kata Sandi Baru<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        </div>
                        @error('password')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold mb-0 pb-0">Konfirmasi Kata Sandi<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        @error('password_confirmation')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary" type="submit">Reset Kata Sandi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>     
</div>
@endsection