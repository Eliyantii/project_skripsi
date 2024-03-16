@extends('dashboard.supplier')

@section('option')
@if ($suppliers->isNotEmpty())
    <div>
        <div class="row">
            <div class="col table-responsive supplier-list">
                <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr class="align-middle">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Kota/Kabupaten</th>
                            <th scope="col">Kode Pos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr class="align-middle" style="cursor: pointer;" onclick="showSupplierDetail('{{ $supplier->id }}');">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->city }}</td>
                                <td>{{ $supplier->postal_code }}</td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    {{-- Supplier Kosong --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada supplier <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
@endif

{{-- Detail Modal --}}
<div class="supplierDetailModal" id="supplierDetailModal"></div>
@endsection
