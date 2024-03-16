@extends('dashboard.produk')

@section('option')
<div>
    <h4 class="text-danger mb-4">Form Penjualan</h4>
    <form action="/karuniamotor/dashboard/product/add" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
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
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    aria-describedby="basic-addon3 basic-addon4" required value="{{ old('name') }}">
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
                <input type="text" name="machine_number"
                    class="form-control @error('machine_number') is-invalid @enderror" id="machine_number"
                    aria-describedby="basic-addon3 basic-addon4" required value="{{ old('machine_number') }}">
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
                    id="bpkb_name" aria-describedby="basic-addon3 basic-addon4" required value="{{ old('bpkb_name') }}">
            </div>
            @error('bpkb_name')
            <div class="mt-2 text-sm text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-4">
            <p class="mb-2 pb-0">Buku Pemilik Kendaraan Bermotor (BPKB)<span class="text-danger">*</span></p>
            <div class="col-3 mb-2">
                <img src="/assets/letter.jpg" class="img-fluid rounded imgBpkbPreview">
            </div>
            <div class="input-group">
                <input type="file" class="form-control" name="bpkb" id="imageBpkb" onchange="previewBpkbImage()"
                    data-accepted="image/*" data-maxFileSize="4">
            </div>
            @error('bpkb')
            <div class="mt-2 text-sm text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-4">
            <p class="mb-2 pb-0">Surat Tanda Nomor Kendaraan (STNK)<span class="text-danger">*</span></p>
            <div class="col-3 mb-2">
                <img src="/assets/letter.jpg" class="img-fluid rounded imgStnkPreview">
            </div>
            <div class="input-group">
                <input type="file" class="form-control" name="stnk" id="imageStnk" onchange="previewStnkImage()"
                    data-accepted="image/*" data-maxFileSize="4">
            </div>
            @error('stnk')
            <div class="mt-2 text-sm text-danger">
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
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    aria-describedby="basic-addon3 basic-addon4" required onkeypress="return hanyaAngka(event)"
                    value="{{ old('price') }}">
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
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" style="height: 100px"></textarea>
            </div>
            @error('description')
            <div class="mt-2 text-sm text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-grid gap-2 mt-4 mb-3">
            <button class="btn btn-primary" type="submit">Posting</button>
        </div>
    </form>
</div>
@endsection
