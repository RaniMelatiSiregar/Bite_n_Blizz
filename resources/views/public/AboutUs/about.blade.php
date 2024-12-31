@extends('public.layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h1 class="display-4 mb-4">Tentang Bite n Blizz</h1>
            <p class="lead text-muted">Kami adalah toko kue yang berkomitmen untuk menyajikan kue-kue berkualitas dengan cita rasa yang lezat dan tampilan yang menarik.</p>
            <hr class="my-4">
            <p class="text-muted">Didirikan pada tahun 2024, Bite n Blizz telah menjadi destinasi favorit pecinta kue di Yogyakarta. Kami menggunakan bahan-bahan berkualitas tinggi dan resep yang telah disempurnakan untuk menghasilkan kue-kue terbaik.</p>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/banner.jpg') }}" alt="About Us" class="img-fluid rounded shadow-sm">
        </div>
    </div>

    <!-- Values Section -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h2>Nilai-Nilai Kami</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                    <h4>Kualitas</h4>
                    <p class="text-muted">Kami selalu mengutamakan kualitas dalam setiap produk yang kami buat.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="fas fa-smile fa-3x text-danger mb-3"></i>
                    <h4>Kepuasan Pelanggan</h4>
                    <p class="text-muted">Kepuasan pelanggan adalah prioritas utama kami dalam memberikan pelayanan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="fas fa-leaf fa-3x text-danger mb-3"></i>
                    <h4>Inovasi</h4>
                    <p class="text-muted">Kami terus berinovasi untuk menghadirkan variasi kue yang unik dan menarik.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h2>Tim Kami</h2>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <img src="{{ asset('images/user4-128x128.jpg') }}" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>Vanisa Indriyani</h4>
                    <p class="text-muted mb-2">Founder</p>
                    <div class="social-links">
                        <a href="https://instagram.com/a.vanisaa" target="_blank" class="text-danger"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <img src="{{ asset('images/user4-128x128.jpg') }}" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>Rani Melati Siregar</h4>
                    <p class="text-muted mb-2">Co-Founder</p>
                    <div class="social-links">
                        <a href="https://instagram.com/ramel9_9" target="_blank" class="text-danger"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <img src="{{ asset('images/user4-128x128.jpg') }}" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>March Sevenia Putri Surga</h4>
                    <p class="text-muted mb-2">Head Chef</p>
                    <div class="social-links">
                        <a href="https://instagram.com/spnptrii" target="_blank" class="text-danger"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <img src="{{ asset('images/user4-128x128.jpg') }}" alt="Team Member" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>Devinda Dhea Indira</h4>
                    <p class="text-muted mb-2">Cake Designer</p>
                    <div class="social-links">
                        <a href="https://instagram.com/devindadea" target="_blank" class="text-danger"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection