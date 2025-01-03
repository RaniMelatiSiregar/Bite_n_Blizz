@extends('public.layouts.app')

@section('content')
<!-- Hero Carousel -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/products/banner-onlineapp.png') }}" class="d-block w-100" alt="Banner 1">
            <div class="carousel-caption">
                <h3>Selamat Datang di Bite n Blizz</h3>
                <p>Temukan berbagai makanan dan minuman lezat</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/products/gambar3.png') }}" class="d-block w-100" alt="Banner 2">
            <div class="carousel-caption">
                <h3>Flash Sale!</h3>
                <p>Dapatkan diskon hingga 50%</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/products/gambar4.png') }}" class="d-block w-100" alt="Banner 3">
            <div class="carousel-caption">
                <h3>Promo Spesial</h3>
                <p>Gratis ongkir untuk pembelian di atas Rp 100.000</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Kategori -->
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-th-large text-danger me-2"></i>Kategori
                    </h5>
                    <div class="row g-4">
                        @foreach($categories as $category)
                        <div class="col-4 col-md-2">
                            <a href="{{ route('product.index', ['category' => $category->id]) }}" class="text-decoration-none text-dark">
                                <div class="text-center category-card">
                                    <div class="rounded-circle bg-light p-3 d-inline-block mb-2">
                                        @switch($category->name)
                                            @case('Kue')
                                                <i class="fas fa-birthday-cake fa-2x text-danger"></i>
                                                @break
                                            @case('Minuman')
                                                <i class="fas fa-coffee fa-2x text-danger"></i>
                                                @break
                                            @case('Snack')
                                                <i class="fas fa-cookie fa-2x text-danger"></i>
                                                @break
                                            @case('Dessert')
                                                <i class="fas fa-ice-cream fa-2x text-danger"></i>
                                                @break
                                            @case('Roti')
                                                <i class="fas fa-bread-slice fa-2x text-danger"></i>
                                                @break
                                            @default
                                                <i class="fas fa-utensils fa-2x text-danger"></i>
                                        @endswitch
                                    </div>
                                    <p class="mb-0 small">{{ $category->name }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flash Sale -->
<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt text-danger me-2"></i>Flash Sale
                    <span class="badge bg-danger ms-2">Berakhir dalam <span id="flashSaleTimer"></span></span>
                </h5>
                <a href="{{ route('product.index') }}" class="btn btn-outline-danger btn-sm">Lihat Semua</a>
            </div>
            <div class="row g-3">
                @foreach($products->take(6) as $product)
                <div class="col-6 col-md-2">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">
                                <i class="fas fa-fire-alt me-1"></i>50% OFF
                            </div>
                            @if($product->qty <= 5)
                            <div class="position-absolute bottom-0 start-0 bg-warning text-dark px-2 py-1 m-2 rounded-pill small">
                                Sisa {{ $product->qty }}
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1 text-truncate">{{ $product->name }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-danger fw-bold">Rp {{ number_format($product->price * 0.5, 0, ',', '.') }}</span>
                                    <br>
                                    <small class="text-muted text-decoration-line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                                </div>
                                <div class="progress-wrapper" style="width: 60px;">
                                    <div class="progress" style="height: 6px; background-color: #ffe0e0;">
                                        @php $progress = rand(60, 90); @endphp
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Terjual {{ rand(50, 100) }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Rekomendasi -->
<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                    <i class="fas fa-thumbs-up text-danger me-2"></i>Rekomendasi
                </h5>
                <a href="{{ route('product.index') }}" class="btn btn-outline-danger btn-sm">Lihat Semua</a>
            </div>
            <div class="row g-3">
                @foreach($products->take(12) as $product)
                <div class="col-6 col-md-2">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            @if($product->qty <= 5)
                            <div class="position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 m-2 rounded-pill small">
                                Sisa {{ $product->qty }}
                            </div>
                            @endif
                        </div>
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1 text-truncate">{{ $product->name }}</h6>
                            <div class="text-danger fw-bold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="text-warning me-1">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <small class="text-muted">{{ number_format(rand(40, 50) / 10, 1) }}</small>
                                </div>
                                <small class="text-muted">Terjual {{ rand(100, 500) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Download App -->
<div class="container mt-4 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4>Download Aplikasi Bite n Blizz</h4>
                    <p class="text-muted">Dapatkan pengalaman belanja yang lebih baik dengan aplikasi kami</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-dark">
                            <i class="fab fa-apple me-2"></i>App Store
                        </a>
                        <a href="#" class="btn btn-dark">
                            <i class="fab fa-google-play me-2"></i>Play Store
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/products/banner-onlineapp.png') }}" alt="Download App" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.carousel-item img {
    height: 400px;
    object-fit: cover;
}

.carousel-caption {
    background: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
}

.category-card {
    transition: transform 0.2s;
}

.category-card:hover {
    transform: translateY(-5px);
}

.product-card {
    transition: transform 0.2s;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-card img {
    height: 150px;
    object-fit: cover;
}
</style>
@endpush

@push('scripts')
<script>
// Flash Sale Timer
function updateTimer() {
    const now = new Date();
    const end = new Date();
    end.setHours(23, 59, 59);
    
    const diff = end - now;
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
    
    document.getElementById('flashSaleTimer').innerHTML = 
        `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

setInterval(updateTimer, 1000);
updateTimer();
</script>
@endpush
@endsection