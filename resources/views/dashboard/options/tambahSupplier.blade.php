@extends('dashboard.supplier')

@section('option')
<form action="/karuniamotor/dashboard/supplier/add" method="POST">
    @csrf
    <div>
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama Supplier<span class="text-danger">*</span></label>
            <div class="input-group"> 
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('name')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Alamat Supplier<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('address')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="province" class="form-label fw-semibold">Provinsi<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" id="province" value="{{ old('province') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('province')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="city" class="form-label fw-semibold">Kota/Kabupaten<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" value="{{ old('city') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('city')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label fw-semibold">Kode Pos<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" aria-describedby="basic-addon3 basic-addon4" onkeypress="return hanyaAngka(event)">
            </div>
            @error('postal_code')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Telepon<span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="812xxxxxxxx" value="{{ old('phone') }}" aria-describedby="basic-addon3 basic-addon4" onkeypress="return hanyaAngka(event)">
            </div>
            @error('phone')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('email')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="account_number" class="form-label fw-semibold">Nomor Rekening<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" id="account_number" value="{{ old('account_number') }}" aria-describedby="basic-addon3 basic-addon4" onkeypress="return hanyaAngka(event)">
            </div>
            @error('account_number')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="account_name" class="form-label fw-semibold">Nama Rekening<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('account_name') is-invalid @enderror" name="account_name" id="account_name" value="{{ old('account_name') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('account_name')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="bank" class="form-label fw-semibold">Bank<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('bank') is-invalid @enderror" name="bank" id="bank" value="{{ old('bank') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('bank')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tax_number" class="form-label fw-semibold">No. NPWP<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('tax_number') is-invalid @enderror" name="tax_number" id="tax_number" value="{{ old('tax_number') }}" aria-describedby="basic-addon3 basic-addon4">
            </div>
            @error('tax_number')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Deskripsi</label>
            <div class="input-group">
                <textarea type="text" class="form-control" name="description" id="description" aria-describedby="basic-addon3 basic-addon4"></textarea>
            </div>
        </div>
        <div class="d-grid gap-2 my-3">
            <button class="btn btn-danger fw-semibold" type="submit">Simpan</button>
        </div>
    </div>
</form>
@endsection