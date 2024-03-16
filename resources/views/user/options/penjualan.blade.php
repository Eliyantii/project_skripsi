@extends('user.profil')

@section('js')
    <script src="/js/pengguna.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-WJb9ERfoYhvgNIKN"></script>
    <script src="/js/checkout.js"></script>
@endsection

@section('option')
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

<div class="row my-3">
    @if ($transactions->isNotEmpty())
        <div class="col">
            <div>
                <h4>Riwayat Transaksi</h4>
            </div>
            <div class="row">
                <div class="col table-responsive">
                    <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Nomor Transaksi</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Status Konfirmasi</th>
                                <th scope="col">Total transaksi</th>
                                <th scope="col">Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr style="cursor: pointer" onclick="showTransactionDetailPopUp('{{ $transaction->id }}');">
                                <td>{{ $transaction->id }}</td>
                                <td>{{ date('d/m/Y h:i', strtotime($transaction->transaction_date)) }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->owner_response }}</td>
                                @if ($transaction->status == 'Dibatalkan')
                                    <td class="text-muted fw-semibold">
                                        Rp0
                                    </td>
                                @else
                                    <td class="fw-semibold">
                                        Rp{{ number_format($transaction->gross_amount, 2, ',', '.') }}
                                    </td>
                                @endif
                                <td><a href="{{ route('viewInvoice', ['transaction' => $transaction->id]) }}" target="_blank" class="btn btn-danger btn-sm me-1 {{ ($transaction->owner_response == "Menunggu") ? "disabled" : "" }}"><i class="bi bi-download"></i> PDF</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        {{-- Transaksi Kosong --}}
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col text-center">
                <div class="mt-5">
                    <h4>Riwayat Transaksi Kosong  <span class="text-danger">&hearts;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/transaksi_kosong.jpg" class="img-fluid">
            </div>
        </div>
    @endif
</div>

<div class="mt-4">
    @if ($transactions->isNotEmpty())
        <div>
            <h4>Riwayat Pembelian</h4>
        </div>
        <div class="col-2 my-3">
            <select class="form-select form-select-md" id="inputGroupSelect" onchange="filterTransaction()">
                <option value="semua_status" selected>Semua Transaksi</option>
                <option value="tertunda">Tertunda</option>
                <option value="selesai">Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>
        <div class="purchase-list overflow-auto" style="max-height: 500px">
            @include('user.options.riwayatPembelian')
        </div>
    @else
        {{-- Transaksi Kosong --}}
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col text-center">
                <div class="mt-5">
                    <h4>Riwayat Transaksi Kosong  <span class="text-danger">&hearts;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/transaksi_kosong.jpg" class="img-fluid">
            </div>
        </div>
    @endif
</div>

<div class="mt-4">
    @if ($products->isNotEmpty())
        <div>
            <h4>Riwayat Penjualan</h4>
        </div>
        <div class="overflow-auto" style="max-height: 500px">
            @foreach ($products as $product)
                <div class="card mb-3" style="max-width: 600px;">
                    <div class="row g-0">
                        <div class="col-md-5 py-2 px-2">
                            <img src="/assets/users/products/{{ $product->imageUser->thumbnail }}" class="img-fluid rounded-start rounded-end">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="mt-0">
                                    <p class="card-text mt-0 mb-1"><small class="text-body-secondary">Terakhir update {{ $product->created_at->locale('id')->diffForHumans(); }}</small></p>
                                    <h5 class="card-title p-0 m-0 fw-bold">{{ ucwords($product->brand) }} {{ ucwords($product->name) }}</h5>
                                    <p class="card-text p-0 m-0 fw-bold text-muted">Harga : Rp<span class="{{ ($product->offer_status == "Ditawar" && $product->offer_price != null) ? "text-decoration-line-through" : "" }}">{{ number_format($product->price, 2, ',','.') }}</span></p>
                                    <p class="card-text p-0 m-0 text-primary fw-bold"><span class="text-muted fw-semibold">Harga Tawar</span> Rp{{ ($product->offer_price == null) ? '0' : number_format($product->offer_price, 2, ',','.') }}</p>
                                </div>
                                <div class="mt-3">
                                    <p class="card-text text-end p-0 m-0 fw-semibold">{{ ($product->offer_status == null) ? "Menunggu" : $product->offer_status }}</p>
                                </div>
                                <div class="mt-2 d-flex">
                                    @if ($product->offer_status == "Ditawar")
                                        <form action="/karuniamotor/profile/transaction/offer/reject/{{ $product->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger me-2">Tolak</button>
                                        </form>
                                        <form action="/karuniamotor/profile/transaction/offer/accept/{{ $product->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Terima</button>
                                        </form>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-end mt-0 pt-0 mb-0 pb-0"><small class="text-body-secondary">{{ date('d-M-Y H:i:s', strtotime($product->updated_at)) }}</small></p>
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
                    <h4>Riwayat Penjualan Kosong  <span class="text-danger">&hearts;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/transaksi_kosong.jpg" class="img-fluid">
            </div>
        </div>
    @endif
</div>

{{-- Modal Transaction --}}
<div class="transactionDetailModal" id="transactionDetailModal"></div>
@endsection
