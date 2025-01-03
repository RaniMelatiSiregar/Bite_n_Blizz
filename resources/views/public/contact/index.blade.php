@extends('public.layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-danger text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Hubungi Kami</h1>
                <p class="lead">Kami siap melayani dan menjawab pertanyaan Anda</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/products/banner-onlineapp.png') }}" alt="Contact Us" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</div>

<!-- Contact Info & Form -->
<div class="container py-5">
    <div class="row g-4">
        <!-- Contact Info -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">Informasi Kontak</h3>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Alamat</h5>
                            <p class="mb-0">Jl. Ringroud Utara, Sleman, Yogyakarta</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Telepon</h5>
                            <p class="mb-0">+62 812-3456-7890</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Email</h5>
                            <p class="mb-0">info@bitenblizz.com</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Jam Operasional</h5>
                            <p class="mb-0">Setiap Hari: 10:00 - 22:00 WIB</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Ikuti Kami</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-danger rounded-circle">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger rounded-circle">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">Kirim Pesan</h3>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nama Lengkap">
                                    <label for="name">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="phone" placeholder="No. Telepon">
                                    <label for="phone">No. Telepon</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="subject">
                                        <option selected disabled>Pilih Subjek</option>
                                        <option>Pertanyaan Umum</option>
                                        <option>Saran & Masukan</option>
                                        <option>Kerjasama</option>
                                        <option>Lainnya</option>
                                    </select>
                                    <label for="subject">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" style="height: 150px" placeholder="Pesan"></textarea>
                                    <label for="message">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map -->
<div class="container-fluid px-0 mb-5">
    <div class="card border-0">
        <div class="card-body p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1527403219694!2d110.4047227!3d-7.7758311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59c7e26aa0c9%3A0x8c5a0d00d3c5cc0!2sRingroad%20Utara%2C%20Sleman%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1704208547477!5m2!1sen!2sid" 
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

@push('styles')
<style>
.form-floating > label {
    padding-left: 1rem;
}

.form-control:focus,
.form-select:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.btn-outline-danger {
    width: 40px;
    height: 40px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-outline-danger:hover {
    transform: translateY(-3px);
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endpush
@endsection 