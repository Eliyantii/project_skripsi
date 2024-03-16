@extends('dashboard.layouts.main')

@section('bottom_js')
    <script src="/js/penawaran.js"></script>
@endsection

@section('main')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang {{ auth()->user()->name }}</h1>
</div>
<div>
    <div class="mb-4 border-bottom border-1">
        <div class="d-flex mb-0 pb-0">
            <a href="/karuniamotor/dashboard/product"
                class="text-decoration-none ps-0 py-2 ms-0 pe-2 fw-bold {{ Request::is('karuniamotor/dashboard/product') ? 'text-primary' : 'text-danger' }}">Daftar
                Motor
            </a>
            <div class="border-end border-1 mb-1 mt-1"></div>
            <a href="/karuniamotor/dashboard/product/add"
                class="text-decoration-none ps-2 py-2 ms-0 fw-bold {{ Request::is('karuniamotor/dashboard/product/add') ? 'text-primary' : 'text-danger' }}">Tambah
                Motor
            </a>
            <div class="ms-auto">
                <a href="/karuniamotor/dashboard/product/report/download" class="btn btn-danger btn-sm p-2 mb-1 rounded-pill justify-content-end">
                    <i class="bi bi-cloud-arrow-down"></i> Laporan Produk
                </a>
            </div>
        </div>
    </div>
    
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

    @yield('option')
</div>
@endsection