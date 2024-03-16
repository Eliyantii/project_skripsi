@extends('home.layouts.utama')

@section('js')
<script src="/js/order.js"></script>
@endsection

@section('content')
<div class="row rounded bg-white py-3 mx-5 mt-5 d-flex justify-content-start flex-md-row flex-column">
    <div class="col-md bg-white overflow-hidden border-2 border p-0 m-0 mx-3 rounded" style="max-height: 20rem">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for ($i = 0; $i < $imageCount; $i++)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}" class="active" aria-current="true" aria-label="Slide {{ $i }}"></button>
                @endfor
            </div>
            <div class="carousel-inner overflow-hidden" style="max-height: 18rem">
                @foreach ($product->imageUser->productImages as $index=>$productImage)
                    <div class="carousel-item {{ ($index == 0) ? 'active' : '' }} overflow-hidden" style="max-height: 315px">
                        <img src="/assets/users/products/{{ $productImage->image }}" class="d-block w-100 rounded img-fluid" style="max-width: 40rem; max-height: 288px">
                    </div>   
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col bg-white p-4">
        <h3 class="fw-bold mb-0 pb-0">{{ $product->brand }} {{ $product->name }}</h3>
        <h2 class="fw-bold mb-0 pb-0 text-danger">Rp{{ number_format($product->price, 2, ',','.') }}</h2>
        <p class="fw-bold m-0 p-0 mb-3">{{ $product->condition }}</p>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0">Tahun</p>
            <p class="fw-bold m-0 p-0 text-danger">{{ $product->year }}</p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Nomor Mesin</p>
            <p class="fw-bold m-0 p-0 text-danger">{{ ucwords($product->machine_number) }}</p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Nomor Rangka</p>
            <p class="fw-bold m-0 p-0 text-danger">{{ ucwords($product->frame_number) }}</p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Status BPKB</p>
            <p class="fw-bold m-0 p-0 text-danger">{{ ($product->bpkb_name != null) ? "Ya" : "Tidak" }}</p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Stok</p>
            <p class="fw-bold m-0 p-0 text-danger">{{ $product->stock }} Unit</p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Transmisi</p>
            <p class="fw-bold m-0 p-0 text-danger">{{ $product->transmission }}</p>
        </div>
    </div>
</div>
<div class="bg-white mx-5 mt-2 p-3 rounded">
    <div class="border-bottom border-1 pb-2 mb-3">
        <h3>Form Pembelian Motor</h3>
    </div>
    @if (session()->has('error'))
        <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="/karuniamotor/cart" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="px-3">
            <input type="hidden" name="product" value="{{ $product }}">
            <small class="text-danger"><i>*Pembelian motor pada website hanya khusus pembelian secara Cash, jika ingin membeli secara Cash Tempo harap untuk ke showroom</i></small>
            <div class="mb-3 mt-3">
                <div class="mb-3">
                    <label for="date_taken" class="form-label fw-semibold">Tanggal Pengambilan Unit<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="date" class="form-control @error('date_taken') is-invalid @enderror" id="date_taken" name="date_taken" value="{{ old('date_taken', $currentDate) }}" required>
                    </div>
                    @error('date_taken')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label fw-semibold">Unit Pembelian<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" required value="{{ old('unit', '1') }}">
                    </div>
                    @error('unit')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3 mb-3 justify-content-center align-items-center">
                <div class="col-md-6 mb-3 text-center">
                    <p class="fw-semibold">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span></p>
                    <div class="mb-2">
                        <img src="/assets/ilustrasi_ktp.jpg" class="img-fluid rounded imgPreviewKTP">
                    </div>
                    <input type="file" id="imageKTP" class="d-none" name="user_card" onchange="previewImageKTP()">
                    <label for="imageKTP" class="btn bg-danger text-white p-1 col-12 text-center rounded mt-0">Pilih Foto</label>
                </div>
                <div class="col-md-6 mb-3 text-center">
                    <p class="fw-semibold">Kartu Keluarga (KK)<span class="text-danger">*</span></p>
                    <div class="mb-2">
                        <img src="/assets/ilustrasi_kartu_keluarga.jpg" class="img-fluid rounded imgPreviewKK">
                    </div>
                    <input type="file" id="imageKK" class="d-none @error('user_family_card') is-invalid @enderror" name="user_family_card" onchange="previewImageKK()">
                    <label for="imageKK" class="btn bg-danger text-white p-1 col-12 text-center rounded mt-0">Pilih Foto</label>
                    @error('user_family_card')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="d-grid gap-2 mt-5">
                <button class="btn btn-danger" type="submit">Masukan Keranjang</button>
            </div>
            {{-- <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold mb-0 pb-0">Nama Lengkap<span
                            class="text-danger">*</span></label>
                    <small class="text-danger p-0 m-0 d-block"><i>*Nama harus sesuai KTP</i></small>
                    <div class="input-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" required value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="residance_address" class="form-label fw-semibold">Alamat Lengkap Domisili<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('residance_address') is-invalid @enderror" id="residance_address"
                            name="residance_address" required value="{{ old('residance_address') }}">
                    </div>
                    @error('residance_address')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold">Nomor Telepon Aktif<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="812xxxxxxxxx" required value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="guarantor_phone" class="form-label fw-semibold">Nomor Telepon Penjamin<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input type="text" class="form-control @error('guarantor_phone') is-invalid @enderror" placeholder="812xxxxxxxxx" id="guarantor_phone"
                            name="guarantor_phone" required value="{{ old('guarantor_phone') }}">
                    </div>
                    @error('guarantor_phone')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="work" class="form-label fw-semibold">Pekerjaan<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('work') is-invalid @enderror" id="work"
                            name="work" required value="{{ old('work') }}">
                    </div>
                    @error('work')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="income" class="form-label fw-semibold">Penghasilan<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('income') is-invalid @enderror" id="income"
                            name="income" required value="{{ old('income') }}">
                    </div>
                    @error('income')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label fw-semibold">Unit Pembelian<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" required value="{{ old('unit', '1') }}">
                    </div>
                    @error('unit')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="date_taken" class="form-label fw-semibold">Tanggal Pengambilan Unit<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="date" class="form-control @error('date_taken') is-invalid @enderror" id="date_taken" name="date_taken" value="{{ old('date_taken') }}" required>
                    </div>
                    @error('date_taken')
                    <div class="mt-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-grid gap-2 mt-5">
                    <button class="btn btn-primary" type="submit">Pengajuan</button>
                </div>
            </div> --}}
        </div>
    </form>
</div>
@endsection
