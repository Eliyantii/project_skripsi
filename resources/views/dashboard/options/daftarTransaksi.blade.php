@extends('dashboard.transaksi')

@section('option')
@if ($transactions->isNotEmpty())
    <div>
        <div class="row">
            <div class="col table-responsive transaction-list">
                <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Nomor Transaksi</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Status Konfirmasi</th>
                            <th scope="col">Total Pemasukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr style="cursor: pointer" onclick="showSalesTransactionDetailPopUp('{{ $transaction->id }}');">
                                <td>{{ $transaction->id }}</td>
                                <td>{{ ucwords($transaction->user->name) }}</td>
                                <td>{{ date('d/m/Y h:i', strtotime($transaction->transaction_date)) }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->owner_response }}</td>
                                @if ($transaction->status == 'Dibatalkan' || $transaction->owner_response == "Ditolak")
                                    <td class="text-muted fw-semibold">
                                        + Rp0
                                    </td>
                                @else
                                    <td class="fw-semibold text-success">
                                        +
                                        Rp{{ number_format($transaction->gross_amount - $transaction->application_fee, 0, ',', '.') }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-end">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Transaksi Kosong --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada transaksi <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
@endif

{{-- Modal Sales Transaction --}}
<div class="transactionDetailModal" id="transactionDetailModal"></div>
@endsection
