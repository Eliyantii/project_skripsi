@extends('user.profil')

@section('option')
<small class="text-danger"><i>*Pada menu penawaran berfungsi untuk pengguna dalam menawarkan produk yaitu motor kepada
        perusahaan. Produk yang ditawarkan dapat dibeli ataupun ditolak oleh perusahaan.</i></small>

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
<div>
    <div class="mb-3 mt-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPenawaran">Buat Penawaran</button>
    </div>
    @if ($products->isNotEmpty())
        <div>
            @foreach ($products as $product)
                <div class="card mb-3" style="max-width: 40rem;">
                    <div class="row g-0">
                        <div class="col-md-5 px-2 py-2">
                            <img src="/assets/users/products/{{ $product->imageUser->thumbnail }}" class="img-fluid rounded-start rounded-end" alt="Thumbnail">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h4 class="card-title text-danger fw-bold">{{ ucwords($product->brand) }} {{ ucwords($product->name) }}</h4>
                                    <div class="btn-group mx-2 position-absolute top-0 end-0">
                                        <button class="btn btn-sm border-0 fs-4" type="button" data-bs-toggle="dropdown">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" onclick="showEditProductModal('{{ $product->id }}');" {{ ($product->offer_status == null || $product->offer_status == "Menunggu") ? "" : "disabled" }}><i class="bi bi-pencil"></i> Edit</button></li>
                                            <li>
                                                <form action="/karuniamotor/profile/offer/delete/{{ $product->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Yakin ingin hapus?')"><i
                                                            class="bi bi-trash3"></i>
                                                        Hapus</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <p class="fw-semibold">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                                <div class="">
                                    <div class="d-flex">
                                        <p class="fw-semibold p-0 m-0 me-2">Tahun</p>
                                        <p class="fw-semibold p-0 m-0 text-muted">{{ $product->year }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fw-semibold p-0 m-0 me-2">Model</p>
                                        <p class="fw-semibold p-0 m-0 text-muted">{{ ucwords($product->transmission) }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fw-semibold p-0 m-0 me-2">Status</p>
                                        <p class="fw-semibold p-0 m-0 text-muted">{{ ($product->offer_status == null) ? "Menunggu" : $product->offer_status }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Penawaran Kosong --}}
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col text-center">
                <div class="mt-5">
                    <h4>Penawaran masih kosong <span class="text-danger">&hearts;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/data_kosong.jpg" class="img-fluid">
            </div>
        </div>
    @endif
</div>

{{-- Edit Produk Modal --}}
<div class="editProductModal" id="editProductModal"></div>

<!-- Tambah Penawaran Modal -->
<div class="modal fade" id="modalPenawaran" tabindex="-1" aria-labelledby="modalPenawaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('storeOffer') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Penawaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-4">
                            <label for="image" class="form-label">Gambar Motor<span class="text-danger">*</span></label>
                            <div class="d-inline my-2">
                                <div id="preview">
                                    <div id="close"></div>
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <input type="file" class="form-control" name="images[]" id="files" multiple
                                    onchange="previewMultiImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="brand">Merek Motor<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select" id="brand" name="brand">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Motor<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" aria-describedby="basic-addon3 basic-addon4" required
                                    value="{{ old('name') }}">
                            </div>
                            @error('name')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="plate_number" class="form-label">Nomor Plat<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror"
                                    id="plate_number" aria-describedby="basic-addon3 basic-addon4" placeholder="KB 98xx XX" required
                                    value="{{ old('plate_number') }}">
                            </div>
                            @error('plate_number')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="machine_number" class="form-label">Nomor Mesin<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="machine_number" class="form-control @error('machine_number') is-invalid @enderror"
                                    id="machine_number" aria-describedby="basic-addon3 basic-addon4" required
                                    value="{{ old('machine_number') }}">
                            </div>
                            @error('machine_number')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="frame_number" class="form-label">Nomor Rangka<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="frame_number" class="form-control @error('frame_number') is-invalid @enderror"
                                    id="frame_number" aria-describedby="basic-addon3 basic-addon4" required
                                    value="{{ old('frame_number') }}">
                            </div>
                            @error('frame_number')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bpkb_name" class="form-label">Nama Pemilik BPKB<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="bpkb_name" class="form-control @error('bpkb_name') is-invalid @enderror"
                                    id="bpkb_name" aria-describedby="basic-addon3 basic-addon4" required
                                    value="{{ old('bpkb_name') }}">
                            </div>
                            @error('bpkb_name')
                                <div class="mt-2 text-sm text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="mb-2 pb-0">Buku Pemilik Kendaraan Bermotor (BPKB)<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                <img src="/assets/letter.jpg" class="img-fluid rounded imgPreview">
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" name="bpkb" id="image"
                                        onchange="previewImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                            @error('bpkb')
                                <div class= "mt-2 text-sm text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="mb-2 pb-0">Surat Tanda Nomor Kendaraan (STNK)<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                <img src="/assets/letter.jpg" class="img-fluid rounded imgPreview">
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" name="stnk" id="image"
                                        onchange="previewImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                            @error('stnk')
                                <div class= "mt-2 text-sm text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="transmission">Transmisi Motor<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select" id="transmission" name="transmission">
                                    <option selected>Automatic</option>
                                    <option value="1">Manual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="year" class="form-label">Tahun<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-select" id="yearpicker" name="year">
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="mb-3">
                            <label for="stock" class="form-label">Stok Unit<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                                    aria-describedby="basic-addon3 basic-addon4" value="1">
                            </div>
                            @error('stock')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" aria-describedby="basic-addon3 basic-addon4" required
                                    onkeypress="return hanyaAngka(event)" value="{{ old('price') }}">
                            </div>
                            @error('price')
                            <div class="mt-2 text-sm text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Keterangan<span class="text-danger">*</span></label>
                            <div class="form-floating">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" style="height: 100px"></textarea>
                            </div>
                            @error('description')
                                <div class= "mt-2 text-sm text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
