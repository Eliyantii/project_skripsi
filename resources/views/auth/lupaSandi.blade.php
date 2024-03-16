@extends('auth.layouts.utama')

@section('content')
<div class="row g-2 d-flex justify-content-between align-items-center">
    <div class="col-6">
        <img src="/assets/Poster_Daftar.png" alt="" class="img-fluid">
    </div>  
    <div class="col-6 justify-center align-content-center">
        <div class="mx-3 my-3 border border-2 border-secondary rounded bg-white p-3">
            <h1 class="text-center fw-bold mb-3">Lupa Kata Sandi</h1>
            @if (session()->has('error'))
                <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('checkEmail') }}" method="POST" autocomplete="off">
                @csrf
                <div class="my-5 px-3">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold mb-0 pb-0">Email Anda<span class="text-danger">*</span></label>
                        <small class="text-danger d-block mt-0 pt-0 mb-2"><i>*Gunakan email saat pertama kali Anda melakukan pendaftaran.</i></small>
                        <div class="input-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary" type="submit">Verifikasi Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>     
</div>
@endsection