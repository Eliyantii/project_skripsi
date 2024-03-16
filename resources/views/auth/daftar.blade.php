@extends('auth.layouts.utama')

@section('content')
<div class="row">
    <div class="col-6">
        <img src="/assets/Poster_Daftar.png" alt="" class="img-fluid">
    </div>  
    <div class="col-6">
        <div class="mx-3 my-3 border border-2 border-secondary rounded bg-white">
            <h1 class="text-center fw-bold mb-3 mt-3">DAFTAR</h1>
            @if (session()->has('success'))
                <div class="mx-3 alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/karuniamotor/register" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="my-5 px-3">
                    <div class="mb-3" style="max-width: 20rem">
                        <p class="fw-semibold">Foto Anda<span class="text-danger">*</span></p>
                        <div class="col-6 mb-2">
                            <img src="/assets/profile.jpg" class="img-fluid rounded imgPreview">
                        </div>
                        <input type="file" id="image" class="d-none @error('image') is-invalid @enderror" value="{{ old('image') }}" name="image" onchange="previewImage()" required>
                        <label for="image" class="bg-primary text-white p-1 col-6 text-center rounded mt-0">Pilih Foto</label>
                        @error('image')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata Sandi<span class="text-danger">*</span></label>
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
                        <label for="gender" class="form-label fw-semibold">Jenis Kelamin<span class="text-danger">*</span></label>
                        <div class="col">
                            <select class="form-select form-select-md" name="gender" id="gender" class="@error('gender') is-invalid @enderror" required value="{{ old('gender') }}">
                                <option value="Laki-laki" selected>Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        @error('gender')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="born" class="form-label fw-semibold">Tanggal Lahir<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="date" class="form-control @error('born') is-invalid @enderror" id="born" name="born" required value="{{ old('born') }}">
                        </div>
                        @error('born')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fw-semibold">Alamat<span class="text-danger">*</span></label>
                        <div class="form-floating">
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" style="height: 100px" required></textarea>
                        </div>
                        @error('address')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Nomor Telepon<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone') }}" placeholder="812xxxxxxxxx">
                        </div>
                        @error('phone')
                            <div class= "mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label fw-semibold">Provinsi<span class="text-danger">*</span></label>
                        <div class="col">
                            <select class="form-select form-select-md" name="province" id="province" class="@error('province') is-invalid @enderror" required value="{{ old('province') }}">
                                <option value="">Select</option>
                            </select>
                        </div>
                        @error('province')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label fw-semibold">Kota/Kabupaten<span class="text-danger">*</span></label>
                        <div class="col">
                            <select class="form-select form-select-md" name="city" id="city" class="@error('city') is-invalid @enderror" required value="{{ old('city') }}">
                                <option value="">Select</option>
                            </select>
                        </div>
                        @error('city')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="subdistrict" class="form-label fw-semibold">Kecamatan<span class="text-danger">*</span></label>
                        <div class="col">
                            <select class="form-select form-select-md" name="subdistrict" id="subdistrict" class="@error('subdistrict') is-invalid @enderror" required value="{{ old('subdistrict') }}">
                                <option value="">Select</option>
                            </select>
                        </div>
                        @error('subdistrict')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="postal_code" class="form-label fw-semibold">Kode Pos<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" required value="{{ old('postal_code') }}">
                        </div>
                        @error('postal_code')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 mt-5">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                    <p class="text-center">Anda sudah daftar?<a href="/karuniamotor/login">Masuk</a></p>
                </div>
            </form>
        </div>
    </div>     
</div>
@endsection