@extends('dashboard.penawaranPelanggan')

@section('option')
@if ($products->isNotEmpty())
    <div>
            <div class="row">
                <div class="col table-responsive">
                    <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Penawaran</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Harga Tawar</th>
                                <th scope="col">Status Penawaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="align-middle" style="cursor: pointer" onclick="showOfferDetailPopUp('{{ $product->id }}');">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d/m/Y h:i', strtotime($product->created_at)) }}</td>
                                    <td>Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                                    <td>{{ ($product->offer_price == null) ? "Rp0" : "Rp". number_format($product->offer_price, 2, ',', '.') }}</td>
                                    <td>{{ ($product->offer_status == null) ? "Menunggu" : $product->offer_status }}</td>
                                    <td class="d-flex justify-content-center align-items-center"> 
                                        <form action="/karuniamotor/dashboard/offer/reject/{{ $product->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm me-1" onclick="event.stopPropagation(); return confirm('Anda yakin ingin menolak penawaran ?');"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                        <button type="submit" class="btn btn-warning btn-sm me-1" onclick="showBidModal('{{ $product->id }}');"><i class="bi bi-pencil"></i></button>
                                        <form action="" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="event.stopPropagation(); return confirm('Anda yakin ingin menerima penawaran ?');"><i class="bi bi-check-lg"></i></button>
                                        </form>
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
    </div>
@else
    {{-- Penawaran Kosong --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada penawaran <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
@endif

{{-- Modal Bid --}}
<div class="bidModal" id="bidModal"></div>

{{-- Detail Modal --}}
<div class="offerDetailModal" id="offerDetailModal"></div>
@endsection

