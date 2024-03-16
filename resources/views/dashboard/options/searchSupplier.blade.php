<script src="/js/dashboard.js"></script>

@if ($suppliers->isNotEmpty())
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

<div class="row">
    <div class="col">
        <div class="d-flex justify-content-start">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@else
<div class="row mt-3 justify-content-center">
    <div class="col-8 text-center justify-content-center">
        <div class="mt-3 mb-5">
            <h4>Tidak Ada Supplier</h4>
        </div>
        <img src="/assets/empty.png" class="img-fluid">
    </div>
</div>
@endif
