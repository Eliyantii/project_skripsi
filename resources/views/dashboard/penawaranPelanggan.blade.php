@extends('dashboard.layouts.main')

@section('main')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang {{ auth()->user()->name }}</h1>
</div>
<div>
    <div class="mb-4 border-bottom border-1">
        <div class="d-flex mb-0 pb-0">
            <a href="/karuniamotor/dashboard/offer"
                class="text-decoration-none ps-0 py-2 pe-2 ms-0 fw-bold {{ Request::is('karuniamotor/dashboard/offer') ? 'text-primary' : 'text-danger' }}">Daftar
                Penawaran</a>
            <div class="border-end border-1 mb-1 mt-1"></div>
            <a href="/karuniamotor/dashboard/offer/pending"
                class="text-decoration-none ps-2 py-2 pe-2 ms-0 fw-bold {{ Request::is('karuniamotor/dashboard/offer/pending') ? 'text-primary' : 'text-danger' }}">Daftar
                Penawaran Pending</a>
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