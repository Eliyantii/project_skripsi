@extends('home.layouts.utama')

@section('js')
<script src="/js/penawaran.js"></script>
@endsection

@section('content')
<div class="mx-3 my-3">
    <div class="bg-white px-3 py-2 rounded">
        <div class="row center">
            <div class="col-md-6">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                        <img src="/assets/users/profile/{{ Auth::user()->image }}" alt="" class="img-thumbnail rounded-circle" style="height: 10rem; width:10rem">
                    </div>
                    <div class="col-md-8">
                        <p class="fw-semibold fs-5 p-0 m-0">{{ ucwords(Auth::user()->name) }}</p>
                        <p class="p-0 m-0 fw-semibold text-muted"><i class="bi bi-geo-alt"></i>
                            {{ ucwords(Auth::user()->subdistrict ) }}, {{ ucwords(Auth::user()->province ) }}</p>
                        <button class="text-primary p-0 btn-ubah-profil" data-bs-toggle="modal"
                            data-bs-target="#ubahDataProfil"><i class="bi bi-pencil"></i> Ubah data diri</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center d-flex justify-content-center align-items-center mt-3">
                <p class="fw-semibold">
                    <i class="bi bi-box2"></i> Total Transaksi <span class="fw-bold text-danger">{{ $count }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white my-2 px-3 py-3 rounded">
        <div class="row">
            <div class="col-4 text-center">
                <a href="/karuniamotor/profile/transaction/snap"
                    class="fw-bold fs-5 text-decoration-none {{ Request::is('karuniamotor/profile/transaction/snap') ? 'active' : 'text-danger' }}"><i
                        class="bi bi-arrow-left-right"></i> Penjualan</a>
            </div>
            <div class="col-4 text-center">
                <a href="/karuniamotor/profile/offer"
                    class="fw-bold fs-5 text-decoration-none {{ Request::is('karuniamotor/profile/offer') ? 'active' : 'text-danger' }}"><i
                        class="bi bi-box2"></i> Penawaran</a>
            </div>
            <div class="col-4 text-center">
                <a href="/karuniamotor/profile/change-password"
                    class="fw-bold fs-5 text-decoration-none {{ Request::is('karuniamotor/profile/change-password') ? 'active' : 'text-danger' }}"><i
                        class="bi bi-key"></i> Ubah Sandi</a>
            </div>
        </div>
    </div>

    <div class="bg-white my-2 px-3 py-2 rounded">
        @yield('option')
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ubahDataProfil" tabindex="-1" aria-labelledby="ubahDataProfilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/karuniamotor/profile/{{ Auth::user()->id }}/change-profile" method="POST" enctype="multipart/form-data" autocomplete="off">
            @method('put')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Diri</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-3">
                            <input type="hidden" name="oldImage" value="{{ Auth::user()->image }}">
                            <p class="fw-semibold">Foto Anda<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                @if (Auth::user()->image)
                                    <img src="/assets/users/profile/{{ Auth::user()->image }}" class="img-fluid rounded imgPreview">
                                @else
                                    <img class="img-fluid rounded imgPreview">
                                @endif
                            </div>
                            <input type="file" id="image" class="d-none" name="image" onchange="previewImage()">
                            <label for="image" class="bg-primary text-white p-1 col-6 text-center rounded mt-0">Pilih Foto</label>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name',  Auth::user()->name) }}">
                            </div>
                            @error('name')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email',  Auth::user()->email) }}">
                            </div>
                            @error('email')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Alamat<span
                                    class="text-danger">*</span></label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required value="{{ old('address', Auth::user()->address) }}">
                                </div>
                            </div>
                            @error('address')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Nomor telepon<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" required value="{{ old('phone', Auth::user()->phone) }}">
                            </div>
                            @error('phone')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="province" class="form-label fw-semibold">Provinsi<span
                                    class="text-danger">*</span></label>
                            <div class="col">
                                <select class="form-select form-select-md" name="province" id="province" class="@error('province') is-invalid @enderror">
                                    <option value="{{ old('province', Auth::user()->province) }}">{{ Auth::user()->province }}</option>
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
                                <select class="form-select form-select-md" name="city" id="city" class="@error('city') is-invalid @enderror">
                                    <option value="{{ old('city', Auth::user()->city) }}">{{ Auth::user()->city }}</option>
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
                                <select class="form-select form-select-md" name="subdistrict" id="subdistrict" class="@error('subdistrict') is-invalid @enderror">
                                    <option value="{{ old('subdistrict', Auth::user()->subdistrict) }}">{{ Auth::user()->subdistrict }}</option>
                                </select>
                            </div>
                            @error('subdistrict')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postal_code" class="form-label fw-semibold">Kode pos<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                    id="postal_code" name="postal_code" required
                                    value="{{ old('postal_code', Auth::user()->postal_code) }}">
                            </div>
                            @error('postal_code')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
