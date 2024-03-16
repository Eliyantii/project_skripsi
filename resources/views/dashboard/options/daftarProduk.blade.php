@extends('dashboard.produk')

@section('option')
@if ($products->isNotEmpty())
    <div class="overflow-auto" style="max-height: 30rem">
        @foreach ($products as $product)    
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center">
                        <img src="/assets/users/products/{{ $product->imageUser->thumbnail }}" class="img-fluid rounded-start ps-2">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-title p-0 m-0 fw-bold">{{ ucwords($product->brand) }} {{ ucwords($product->name) }}</h6>
                                    <div class="btn-group mx-2 position-absolute top-0 end-0">
                                        <button class="btn btn-sm border-0 fs-4" type="button" data-bs-toggle="dropdown">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" onclick="showAdminProductEdit('{{ $product->id }}');"><i class="bi bi-pencil"></i> Ubah</button></li>
                                            <li>
                                                <form action="/karuniamotor/dashboard/product/delete/{{ $product->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Yakin ingin hapus?')"><i class="bi bi-trash3"></i>
                                                        Hapus</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 fw-bold"><span class="text-muted fw-semibold">Harga : </span> Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                                <p class="card-text p-0 m-0 fw-bold"><span class="text-muted fw-semibold">Nomor Polisi : </span> {{ strtoupper( $product->plate_number) }}</p>
                                <p class="card-text p-0 m-0 fw-bold"><span class="text-muted fw-semibold">Unit : </span> {{ $product->stock }}x</p>
                            </div>
                            <div>
                                <p class="card-text text-end p-0 m-0"><small class="text-body-secondary">Terakhir post {{ $product->created_at->locale('id')->diffForHumans(); }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- Produk Kosong --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada produk <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
@endif

{{-- Edit Produk Modal --}}
<div class="editProductModal" id="editProductModal"></div>
@endsection
