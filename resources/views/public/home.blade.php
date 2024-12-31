@extends('public.layouts.app')

@section('content')
<!-- Carousel -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/carousel1.jpg') }}" class="d-block w-100" alt="Carousel 1" style="height: 500px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/carousel2.jpg') }}" class="d-block w-100" alt="Carousel 2" style="height: 500px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/carousel3.jpg') }}" class="d-block w-100" alt="Carousel 3" style="height: 500px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/carousel4.jpg') }}" class="d-block w-100" alt="Carousel 4" style="height: 500px; object-fit: cover;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Best Selling Products -->
<div class="container py-5">
    <h2 class="text-center mb-4">Best Selling Products</h2>
    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/chocoCrispy1.png') }}" class="card-img-top" alt="Choco Crispy" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Choco Crispy</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp25.000</p>
                    <a href="{{ route('product') }}" class="btn btn-danger mt-auto">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/chocoMilk.png') }}" class="card-img-top" alt="Choco Milk" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Choco Milk</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp18.000</p>
                    <a href="{{ route('product') }}" class="btn btn-danger mt-auto">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/browniesChoco.png') }}" class="card-img-top" alt="Brownies Choco" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Brownies Choco</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp28.000</p>
                    <a href="{{ route('product') }}" class="btn btn-danger mt-auto">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Product 4 -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/bananaCake.png') }}" class="card-img-top" alt="Banana Cake" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Banana Cake</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp23.000</p>
                    <a href="{{ route('product') }}" class="btn btn-danger mt-auto">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/banner.jpg') }}" alt="About Us" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Tentang Bite n Blizz</h2>
                <p class="lead text-muted">Kami adalah toko kue yang berkomitmen untuk menyajikan kue-kue berkualitas dengan cita rasa yang lezat dan tampilan yang menarik.</p>
                <p class="text-muted mb-4">Didirikan pada tahun 2023, Bite n Blizz telah menjadi destinasi favorit pecinta kue di Yogyakarta. Kami menggunakan bahan-bahan berkualitas tinggi dan resep yang telah disempurnakan untuk menghasilkan kue-kue terbaik.</p>
                <a href="{{ route('about') }}" class="btn btn-danger">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="container py-5">
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <h2 class="mb-4">Hubungi Kami</h2>
            <p class="text-muted mb-5">Jika Anda memiliki pertanyaan atau ingin memesan produk kami, silakan hubungi kami melalui:</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-map-marker-alt fa-2x text-danger mb-3"></i>
                    <h5>Alamat</h5>
                    <p class="text-muted">Depok, Sleman, Yogyakarta</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-phone fa-2x text-danger mb-3"></i>
                    <h5>Telepon</h5>
                    <p class="text-muted">+62 812-3456-7890</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-envelope fa-2x text-danger mb-3"></i>
                    <h5>Email</h5>
                    <p class="text-muted">@bitenblizz.com</p>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-danger mt-3">Hubungi Kami</a>
        </div>
    </div>
</div>
@endsection