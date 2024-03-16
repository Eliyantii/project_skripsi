@extends('user.profil')

@section('option')
<div class="px-3 py-3">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="/karuniamotor/profile/{{ auth()->user()->id }}/change-password" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div>
            <div class="mb-3">
                <label for="oldPassword" class="form-label fw-semibold">Kata Sandi Lama<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" name="oldPassword" aria-describedby="basic-addon3 basic-addon4" required>
                </div>
                @error('oldPassword')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Kata Sandi Baru<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="basic-addon3 basic-addon4" required>
                </div>
                @error('password')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" aria-describedby="basic-addon3 basic-addon4" required>
                </div>
                @error('password_confirmation')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" onclick="return confirm('Anda yakin ingin ubah kata sandi ?')">Ubah Kata Sandi</button>
            </div>
        </div>

    </form>
</div>
@endsection