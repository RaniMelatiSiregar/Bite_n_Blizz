@extends('public.layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-danger text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Tentang Bite n Blizz</h1>
                <p class="lead">Menyajikan Kelezatan dalam Setiap Gigitan dan Tegukan</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/products/banner-onlineapp.png') }}" alt="About Us" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</div>

<!-- Visi Misi Section -->
<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-danger mb-3">
                        <i class="fas fa-eye fa-2x"></i>
                    </div>
                    <h3 class="card-title mb-3">Visi Kami</h3>
                    <p class="card-text">Menjadi destinasi kuliner terpercaya yang menghadirkan pengalaman menikmati makanan dan minuman berkualitas dengan pelayanan terbaik untuk semua pelanggan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-danger mb-3">
                        <i class="fas fa-bullseye fa-2x"></i>
                    </div>
                    <h3 class="card-title mb-3">Misi Kami</h3>
                    <ul class="card-text">
                        <li>Menyediakan produk makanan dan minuman berkualitas tinggi</li>
                        <li>Mengutamakan kebersihan dan keamanan dalam setiap proses produksi</li>
                        <li>Memberikan pelayanan yang ramah dan profesional</li>
                        <li>Berinovasi dalam menu dan layanan secara berkelanjutan</li>
                        <li>Membangun hubungan yang baik dengan pelanggan dan mitra</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Nilai-nilai Kami -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nilai-nilai Kami</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-heart fa-2x"></i>
                    </div>
                    <h4>Passion</h4>
                    <p>Kami mencintai apa yang kami lakukan dan selalu memberikan yang terbaik.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <h4>Kualitas</h4>
                    <p>Kami mengutamakan kualitas dalam setiap produk yang kami sajikan.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4>Pelayanan</h4>
                    <p>Kepuasan pelanggan adalah prioritas utama kami.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-sync fa-2x"></i>
                    </div>
                    <h4>Inovasi</h4>
                    <p>Kami terus berinovasi untuk menghadirkan pengalaman terbaik.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tim Kami -->
<div class="container py-5">
    <h2 class="text-center mb-5">Tim Kami</h2>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <img src="{{ asset('images/tim/vanisa.jpg') }}" alt="Vanisa" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>Vanisa Indriyani</h4>
                    <p class="text-muted">Founder</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <img src="{{ asset('images/tim/devinda.jpg') }}" alt="Devinda" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>Devinda Dhea Indrira</h4>
                    <p class="text-muted">Co-Founder</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <img src="{{ asset('images/tim/putri.jpg') }}" alt="March" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>March Sevenia Putri</h4>
                    <p class="text-muted">Head Chef</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <img src="{{ asset('images/tim/rani.jpg') }}" alt="Rani" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>Rani Melati Siregar</h4>
                    <p class="text-muted">Manager</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="bg-danger text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <h2 class="display-4 fw-bold mb-2">500+</h2>
                    <p class="mb-0">Menu Tersedia</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h2 class="display-4 fw-bold mb-2">1000+</h2>
                    <p class="mb-0">Pelanggan Puas</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h2 class="display-4 fw-bold mb-2">50+</h2>
                    <p class="mb-0">Staff Profesional</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h2 class="display-4 fw-bold mb-2">5+</h2>
                    <p class="mb-0">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.rounded-circle {
    transition: transform 0.3s ease;
}

.rounded-circle:hover {
    transform: scale(1.1);
}

.btn-outline-danger {
    width: 35px;
    height: 35px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.display-4 {
    font-size: 2.5rem;
}

@media (min-width: 768px) {
    .display-4 {
        font-size: 3.5rem;
    }
}
</style>
@endpush
@endsection 