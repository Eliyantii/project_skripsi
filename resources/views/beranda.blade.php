@extends('home.layouts.utama')

@section('hero-image')
<h1 class="text-center text-danger fw-bold">Karunia Motor</h1>
@if ($products->count() && $latestProducts->count())
<div id="carouselExampleIndicators" class="carousel slide slider col-12 mx-3 my-3">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/assets/Image_KaruniaMotor.jpeg" class="d-block w-100 h-50" alt="Image">
      </div>
      <div class="carousel-item">
        <img src="/assets/Informasi Kontak.png" class="d-block w-100 h-50" alt="Image">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection

@section('content')
<div class="mx-3 my-3">
    <h3 class="fw-bold">Produk Terbaru</h3>
    <div class="row mb-4 card-container">
        @foreach ($latestProducts as $latestProduct)
          <a href="/karuniamotor/detail/{{ $latestProduct->id }}" class="btn col-sm-3 mb-3" style="width: 13rem;">
              <div class="card home-card" style="height: 17rem">
                  <img src="/assets/users/products/{{ $latestProduct->imageUser->thumbnail }}" class="card-img-top img-fluid" style="height: 8rem">
                  <div class="card-body">
                      <p class="card-text p-0 m-0 fw-bold">{{ $latestProduct->brand }} {{ $latestProduct->name }}</p>
                      <p class="card-text fw-semibold"><span class="text-muted">Tahun</span> {{ $latestProduct->year }}</p>
                      <p class="card-text p-0 m-0 fw-semibold text-danger">Rp{{ number_format($latestProduct->price, 2, ',', '.') }}</p>
                  </div>
              </div>
          </a>
        @endforeach
      </div>   
    <h3 class="fw-bold">Semua Produk</h3>
    <div class="row mb-4">
        @foreach ($products as $product)
          <a href="/karuniamotor/detail/{{ $product->id }}" class="btn col-sm-3 mb-3" style="width: 13rem;">
              <div class="card home-card" style="height: 17rem">
                  <img src="/assets/users/products/{{ $product->imageUser->thumbnail }}" class="card-img-top img-fluid" style="height: 8rem">
                  <div class="card-body">
                      <p class="card-text p-0 m-0 fw-bold">{{ $product->brand }} {{ $product->name }}</p>
                      <p class="card-text fw-semibold"><span class="text-muted">Tahun</span> {{ $product->year }}</p>
                      <p class="card-text p-0 m-0 fw-semibold text-danger">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                  </div>
              </div>
          </a>
        @endforeach
    </div>
</div>
@else
{{-- Produk Kosong --}}
<div class="row d-flex justify-content-center align-items-center">
  <div class="col text-center">
    <div class="mt-5">
      <h4>Produk Tidak Ada  <span class="text-danger">&#128517;</span></h4>
    </div>
    <div class="mt-3">
      <img src="/assets/empty.png" class="img-fluid">
    </div>
  </div>
</div>
@endif
@endsection