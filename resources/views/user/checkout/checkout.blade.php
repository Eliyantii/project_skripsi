@extends('home.layouts.utama')

@section('js')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-WJb9ERfoYhvgNIKN"></script>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="bg-white px-3 py-4 rounded">
                <h3 class="text-center fw-bold mb-3">Detail Pembelian</h3>
                <div class="bg-light px-5 rounded">
                    <?php $totalHarga = 0; ?>
                    @foreach ($cart->cartDetails as $cartDetail)
                        <?php $totalHarga += $cartDetail->product->price * $cartDetail->unit; ?>
                        <div class="row my-3 py-3 border-2 border-bottom">
                            <div class="col-12 col-md-2 p-0 mb-3 mb-md-0">
                                <img src="/assets/users/products/{{ $cartDetail->product->imageUser->thumbnail }}" class="img-fluid rounded border border-2" style="width: 12rem">
                            </div>
                            <div class="col-9 ms-2">
                                <div class="row">
                                    <div class="col">
                                        <p class="fw-bold pb-0 mb-0">{{ ucwords($cartDetail->product->brand) }} {{ ucwords($cartDetail->product->name) }}</p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="fw-bold pb-0 mb-0 text-danger"><span class="text-muted">Subtotal : </span> Rp{{ number_format($cartDetail->product->price * $cartDetail->unit, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                                <p class="fw-bold pb-0 mb-0"><span class="text-muted">Harga: </span> Rp{{ number_format($cartDetail->product->price, 2, ',', '.') }}</p>
                                <p class="fw-semibold pb-0 mb-0 mt-1 text-danger"><span class="text-muted">Unit:</span> {{ $cartDetail->unit }}x</p>
                                <p class="fw-semibold pb-0 mb-0 mt-1 text-danger"><span class="text-muted">Nomor Mesin:</span> {{ ucwords($cartDetail->product->machine_number) }}</p>
                                <p class="fw-semibold pb-0 mb-0 mt-1 text-danger"><span class="text-muted">Nomor Mesin:</span> {{ $cartDetail->product->frame_number }}</p>
                                <p class="fw-semibold pb-0 mb-0 mt-1 text-danger"><span class="text-muted">Transmisi:</span> {{ $cartDetail->product->transmission }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col text-end">
                            <p class="fw-bold fs-5"><span class="text-muted">Total :</span> {{ number_format($totalHarga, 2, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="border-1 border-bottom">
                        <h5 class="border-1 border-bottom py-2">Ringkasan Pembayaran</h5>
                        <div class="mt-3">
                            <div class="row justify-content-between">
                                <div class="col mb-0 pb-0">
                                    <p class="fw-semibold text-muted">Total Bayar</p>
                                </div>
                                <div class="col mb-0 pb-0 text-end">
                                    <input type="hidden" name="productBill" id="productBill" value="{{ $totalHarga }}">
                                    <p class="fw-semibold">Rp{{ number_format($totalHarga, 2, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col mb-0 pb-0">
                                    <p class="fw-semibold text-muted">Biaya Jasa Aplikasi</p>
                                </div>
                                <div class="col mb-0 pb-0 text-end">
                                    <p class="fw-semibold">Rp{{ number_format(2000, 2, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col mb-0 pb-0">
                                    <p class="fw-semibold text-muted">Biaya Administrasi</p>
                                </div>
                                <div class="col mb-0 pb-0 text-end">
                                    <p class="fw-semibold">Rp{{ number_format(3000, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p class="text-muted fw-bold fs-5">Total Bayar</p>
                        </div>
                        <div class="col text-end">
                            <input type="hidden" name="totalBill" id="totalBill" value="">
                            <p class="fw-bold fs-5">Rp<span id="totalBillText" name="totalBillText"></span></p>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        @csrf
                        <button class="btn btn-danger btn-bayar-checkout btn-send mb-3" type="submit" id="pay-button" onclick="checkout({{ $cart->id }}, '{{ csrf_token() }}')">
                            Bayar Sekarang
                        </button>
                        <button class="btn btn-danger text-white d-none btn-load w-100 checkout-page-btn" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </button>
                    </div>
                </div>
            
                <form id="snapCallbackForm" method="POST">
                    @csrf
                    <input type="hidden" name="snapCallback" id="snapCallback">
                    <input type="hidden" name="cartId" value="{{ $cart->id }}">
                    <input type="hidden" name="snapToken" id="snapToken">
            
                    @foreach ($cart->cartDetails as $cartDetail)
                        <input type="hidden" id="user_card" name="user_card" value="{{ $cartDetail->user_card }}">
                        <input type="hidden" name="user_family_card" id="user_family_card" value="{{ $cartDetail->user_family_card }}">   
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endsection