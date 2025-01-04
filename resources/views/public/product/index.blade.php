@extends('public.layouts.app')

@section('content')
<div class="container-fluid bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-danger">Home</a></li>
                <li class="breadcrumb-item active">Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">
        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <!-- Kategori -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">Kategori</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('product.index') }}" 
                           class="list-group-item list-group-item-action border-0 {{ !request('category') ? 'active text-white bg-danger' : '' }}">
                            <i class="fas fa-th-large me-2"></i>Semua Produk
                            <span class="badge bg-{{ !request('category') ? 'light text-danger' : 'secondary' }} float-end">
                                {{ $products->count() }}
                            </span>
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('product.index', ['category' => $category->id]) }}" 
                           class="list-group-item list-group-item-action border-0 {{ request('category') == $category->id ? 'active text-white bg-danger' : '' }}">
                            <i class="fas fa-tag me-2"></i>{{ $category->name }}
                            <span class="badge bg-{{ request('category') == $category->id ? 'light text-danger' : 'secondary' }} float-end">
                                {{ $products->where('category_id', $category->id)->where('is_available', true)->count() }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Filter Harga -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-3">Rentang Harga</h6>
                    <form action="{{ route('product.index') }}" method="GET">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Terapkan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Produk Grid -->
        <div class="col-lg-9">
            <!-- Sorting dan View Options -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-end align-items-center">
                        <select class="form-select w-auto">
                            <option>Terbaru</option>
                            <option>Harga: Rendah ke Tinggi</option>
                            <option>Harga: Tinggi ke Rendah</option>
                            <option>Terlaris</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row g-3">
                @forelse($products as $product)
                    @if($product->is_available) <!-- Menambahkan filter untuk hanya menampilkan produk yang tersedia -->
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @if($product->qty <= 5 && $product->qty > 0)
                                <div class="position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 small">
                                    Stok Terbatas
                                </div>
                                @elseif($product->qty == 0)
                                <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 small">
                                    Stok Habis
                                </div>
                                @endif
                            </div>
                            <div class="card-body p-3">
                                <h6 class="card-title mb-1 text-truncate">{{ $product->name }}</h6>
                                <div class="text-danger fw-bold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= rand(4, 5))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-muted ms-1">({{ rand(10, 100) }})</small>
                                    <small class="text-muted ms-auto">{{ rand(50, 200) }} terjual</small>
                                </div>
                                @if($product->qty > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="d-flex gap-2 mb-2">
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary" onclick="decrementQty(this)">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->qty }}"
                                                class="form-control text-center" style="width: 60px;"
                                                onchange="validateQty(this, {{ $product->qty }})">
                                            <button type="button" class="btn btn-outline-secondary" onclick="incrementQty(this)">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                        </button>
                                    </div>
                                </form>
                                @else
                                <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif <!-- End of check for availability -->
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <img src="{{ asset('images/empty.svg') }}" alt="Tidak ada produk" class="mb-3" style="max-width: 200px;">
                        <h5>Tidak ada produk yang ditemukan</h5>
                        <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.product-card {
    transition: transform 0.2s;
}
.product-card:hover {
    transform: translateY(-5px);
}
.product-card img {
    height: 200px;
    object-fit: cover;
}
.list-group-item.active {
    border-color: #dc3545;
}
.list-group-item:hover:not(.active) {
    background-color: #f8f9fa;
}
</style>
@endpush

@push('scripts')
<script>
function decrementQty(btn) {
    const input = btn.parentElement.querySelector('input');
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
    }
}

function incrementQty(btn) {
    const input = btn.parentElement.querySelector('input');
    const currentValue = parseInt(input.value);
    const maxValue = parseInt(input.max);
    if (currentValue < maxValue) {
        input.value = currentValue + 1;
    }
}

function validateQty(input, maxQty) {
    const value = parseInt(input.value);
    if (value < 1) {
        input.value = 1;
    } else if (value > maxQty) {
        input.value = maxQty;
    }
}
</script>
@endpush
@endsection
