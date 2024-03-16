@extends('dashboard.cashTempo')

@section('option')
<div class="my-5">
    <form action="/karuniamotor/dashboard/cash-tempo/form/add" method="POST" enctype="multipart/form-data"
        autocomplete="off">
        @csrf
        <div class="d-flex flex-wrap">
            <div class="mb-3 col-md-5 px-2">
                <p class="fw-semibold">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span></p>
                <div class="mb-2">
                    <img src="/assets/ilustrasi_ktp.jpg" class="img-fluid rounded imgPreviewKTP">
                </div>
                <input type="file" id="imageKTP" class="d-none" name="user_card" onchange="previewImageKTP()">
                <label for="imageKTP" class="btn bg-primary text-white p-1 w-100 text-center rounded mt-0">Pilih
                    Foto</label>
            </div>
            <div class="mb-3 col-md-5 px-2">
                <p class="fw-semibold">Kartu Keluarga (KK)<span class="text-danger">*</span></p>
                <div class="mb-2">
                    <img src="/assets/ilustrasi_kartu_keluarga.jpg" class="img-fluid rounded imgPreviewKK">
                </div>
                <input type="file" id="imageKK" class="d-none @error('user_family_card') is-invalid @enderror"
                    name="user_family_card" onchange="previewImageKK()">
                <label for="imageKK" class="btn bg-primary text-white p-1 w-100 text-center rounded mt-0">Pilih
                    Foto</label>
                @error('user_family_card')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="mt-5">
            <div class="my-3">
                <p class="fs-5 fw-bold text-danger">Data Motor</p>
            </div>
            <div>
                <div class="input-group mb-3">
                    <label class="form-label fw-semibold" for="product_id">Jenis Motor<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select" id="product_id" name="product_id">
                            <option value="">Pilih</option>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <option 
                                        value="{{ $product->id }}"
                                        data-plate-number="{{ strtoupper($product->plate_number) }}"
                                        data-machine-number="{{ strtoupper($product->machine_number) }}"
                                        data-frame-number="{{ $product->frame_number }}"
                                    >
                                        {{ $product->year }}-{{ $product->brand }} {{ ucwords($product->name) }} ({{ strtoupper($product->plate_number) }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="plate_number" class="form-label fw-semibold">Nomor Polisi</label>
                    <div class="input-group">
                        <input type="text" name="plate_number" class="form-control" id="plate_number" aria-describedby="basic-addon3 basic-addon4" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="machine_number" class="form-label fw-semibold">Nomor Mesin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="machine_number" name="machine_number" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="frame_number" class="form-label fw-semibold">Nomor rangka</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="frame_number" name="frame_number" disabled>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-3 mt-5">
            <div class="my-2">
                <p class="fw-bold text-danger fs-5">Data Konsumen</p>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label fw-semibold mb-0 pb-0">Nama Lengkap<span
                        class="text-danger">*</span></label>
                <small class="text-danger p-0 m-0 d-block"><i>*Nama harus sesuai KTP</i></small>
                <div class="input-group">
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                        id="customer_name" name="customer_name" required value="{{ old('customer_name') }}">
                </div>
                @error('customer_name')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-semibold">Alamat Lengkap Domisili<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" required value="{{ old('address') }}">
                </div>
                @error('address')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Nomor Telepon Aktif<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                        placeholder="812xxxxxxxxx" required value="{{ old('phone') }}">
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
                    <input type="text" class="form-control @error('guarantor_phone') is-invalid @enderror"
                        placeholder="812xxxxxxxxx" id="guarantor_phone" name="guarantor_phone" required
                        value="{{ old('guarantor_phone') }}">
                </div>
                @error('guarantor_phone')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="work" class="form-label fw-semibold">Pekerjaan<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control @error('work') is-invalid @enderror" id="work" name="work"
                        required value="{{ old('work') }}">
                </div>
                @error('work')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="income" class="form-label fw-semibold">Penghasilan<span class="text-danger">*</span></label>
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
            <div class="input-group mb-3">
                <label class="form-label fw-semibold" for="month">Jangka Cash Tempo<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="month" name="month">
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="dp" class="form-label fw-semibold mb-0">Down Payment (DP)<span
                        class="text-danger">*</span></label>
                <small class="text-danger d-block mt-0 pt-0"><i>*DP harus 50% dari harga motor</i></small>
                <div class="input-group">
                    <input type="number" class="form-control @error('dp') is-invalid @enderror" id="dp" name="dp"
                        required value="{{ old('dp') }}">
                </div>
                @error('dp')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <label class="form-label fw-semibold" for="interest">Bunga (Per-Bulan)<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="interest" name="interest">
                        <option value="0.0">0%</option>
                        <option value="0.05">5%</option>
                        <option value="0.06">6%</option>
                        <option value="0.07">7%</option>
                        <option value="0.08">8%</option>
                        <option value="0.09">9%</option>
                        <option value="0.1">10%</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label fw-semibold">Unit Pembelian<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit"
                        required value="{{ old('unit') }}">
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
                    <input type="date" class="form-control @error('date_taken') is-invalid @enderror" id="date_taken"
                        name="date_taken" value="{{ old('date_taken') }}" required>
                </div>
                @error('date_taken')
                <div class="mt-2 text-sm text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="d-grid gap-2 my-5">
            <button class="btn btn-primary" type="submit">Pengajuan</button>
        </div>
    </form>
</div>
</div>
@endsection
