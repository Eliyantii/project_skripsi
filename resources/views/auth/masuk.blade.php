@extends('auth.layouts.utama')

@section('content')
<div class="row g-2 d-flex justify-content-between align-items-center">
    <div class="col-6">
        <img src="/assets/Poster_Daftar.png" alt="" class="img-fluid">
    </div>  
    <div class="col-6 justify-center align-content-center">
        <div class="mx-3 my-3 border border-2 border-secondary rounded bg-white p-3">
            <h1 class="text-center fw-bold mb-3">MASUK</h1>
            @if (session()->has('error'))
                <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/karuniamotor/login" method="POST">
                @csrf
                <div class="my-5 px-3">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Anda<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata sandi<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        </div>
                        @error('password')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mt-5">
                        <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                    <div class="row d-lfex justify-content-between align-items-start">
                        <a class="col" href="/karuniamotor/register">Daftar</a>
                        <a class="col text-end" href="/karuniamotor/forgot-password">Lupa kata sandi</a>
                    </div>
                </div>
            </form>
        </div>
    </div>     
</div>
@endsection