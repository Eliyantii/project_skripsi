@extends('dashboard.cashTempo')

@section('option')
<div>
    @if ($cashTempos->isNotEmpty())
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr class="align-middle">
                            <th scope="col">Nomor Transaksi</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Bayar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Sisa Bulan</th>
                            <th scope="col">Bunga</th>
                            <th scope="col">Angsuran</th>
                            <th scope="col">Total Sisa</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cashTempos as $cashTempo)
                            <tr class="align-middle">
                                <td>{{ $cashTempo->id }}</td>
                                <td>{{ date('d/m/Y h:i', strtotime($cashTempo->date_taken)) }}</td>
                                <td>Rp{{ number_format($cashTempo->dp, 2, ',', '.') }}</td>
                                <td>{{ ucwords($cashTempo->status) }}</td>
                                <td>{{ $cashTempo->month }}</td>
                                <td>{{ $cashTempo->interest }}</td>
                                <td>Rp{{ number_format($cashTempo->installment) }}</td>
                                <td>Rp{{ number_format($cashTempo->remaining_total) }}</td>
                                <td>
                                    <button class="btn p-0 m-0 rounded-pill fw-semibold {{ ($cashTempo->status == "Lunas") ? "text-danger border-0" : "text-success" }}" {{ ($cashTempo->status == "Lunas") ? "disabled" : "" }} onclick="payCashTempo('{{ $cashTempo->id }}')">Bayar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-end">
                    {{ $cashTempos->links() }}
                </div>
            </div>
        </div>
    @else
        {{-- Cash Tempo Kosong --}}
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col text-center">
                <div class="mt-5">
                    <h4>Belum ada Cash Tempo <span class="text-danger">&#128517;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/data_kosong.jpg" class="img-fluid">
            </div>
        </div>
    @endif
</div>

{{-- Modal Pembayaran --}}
<div class="payPopUpModal" id="payPopUpModal"></div>
@endsection
