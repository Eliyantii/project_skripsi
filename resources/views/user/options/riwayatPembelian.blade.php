@foreach ($transactions as $transaction)
    @foreach ($transaction->transactionDetails as $transactionDetail)
        <div class="card mb-3" style="max-width: 600px;">
            <div class="row g-0">
                <div class="col-md-5 py-2 px-2">
                    <img src="/assets/users/products/{{ $transactionDetail->historyPurchase->image }}" class="img-fluid rounded-start rounded-end">
                </div>
                <div class="col-md-7">
                    <div class="card-body mt-0 pt-0">
                        <div class="mb-2">
                            <p class="card-text p-0 m-0"><small class="text-body-secondary">Transaksi terakhir
                                    {{ $transaction->created_at->locale('id')->diffForHumans(); }}</small></p>
                        </div>
                        <div class="mb-1">
                            <h5 class="card-title p-0 m-0 fw-bold">
                                {{ ucwords($transactionDetail->historyPurchase->brand) }}
                                {{ ucwords($transactionDetail->historyPurchase->name) }}</h5>
                            <p class="card-text p-0 m-0 fw-bold text-danger">
                                Rp{{ number_format($transactionDetail->historyPurchase->price, 2, ',', '.') }}</p>
                            <p class="card-text p-0 m-0 fw-semibold"><span class="text-muted">Unit : </span>
                                {{ $transactionDetail->unit }}x</p>
                            <p class="card-text p-0 m-0 fw-semibold"><span class="text-muted">Total : </span>
                                Rp{{ number_format($transaction->gross_amount, 2, ',', '.') }}</p>
                        </div>
                        <div class="d-flex justify-content-end mb-0 pb-0">
                            @if ($transaction->status == "Berhasil" && $transaction->owner_response == "Menunggu")
                                <p class="fw-bold mb-0">{{ $transaction->owner_response }}...</p>
                            @elseif($transaction->status == "Tertunda")
                                <form action="{{ route('cancelPayment', ['transaction'=>$transaction->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger me-2">Batal</button>
                                </form>

                                <button type="submit" class="btn btn-success" id="payBtn" onclick="makePayment('{{ $transaction->snap_token }}'); return false;">Bayar</button>

                            @else
                                <p class="fw-semibold">{{ $transaction->owner_response }}</p>
                            @endif
                        </div>
                        <p class="text-end mt-0 pt-0 mb-0 pb-0"><small class="text-body-secondary">{{ date('d-M-Y H:i:s', strtotime($transaction->updated_at)) }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

{{-- snap callback --}}
<form id="snapCallbackForm" method="POST">
    @csrf
    <input type="hidden" name="snapCallback" id="snapCallback">
    <input type="hidden" name="snapToken" id="snapToken">
</form>
