<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Products</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    @include('public.layouts.header')
    <!-- Carousel Section -->
    <div id="productCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Category Section -->
    <h2 class="mb-4">Categories</h2>
    <div class="row mb-5">
        <div class="col-md-2">
            <div class="category-card">
                <img src="path-to-image/category1.jpg" alt="Category 1" class="img-fluid mb-3">
                <p>Category 1</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-card">
                <img src="path-to-image/category2.jpg" alt="Category 2" class="img-fluid mb-3">
                <p>Category 2</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-card">
                <img src="path-to-image/category3.jpg" alt="Category 3" class="img-fluid mb-3">
                <p>Category 3</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-card">
                <img src="path-to-image/category4.jpg" alt="Category 4" class="img-fluid mb-3">
                <p>Category 4</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-card">
                <img src="path-to-image/category5.jpg" alt="Category 5" class="img-fluid mb-3">
                <p>Category 5</p>
            </div>
        </div>
    </div>
        <!-- Product Grid -->
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/' . $product->image) }}" 
                     class="card-img-top" 
                     alt="{{ $product->name }}"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                            <input type="hidden" name="quantity" value="1">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" style="background-color: #ee4d2d; border-color: #ee4d2d;">
                                    <i class="fas fa-shopping-cart me-1"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notifikasi</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Produk berhasil ditambahkan ke keranjang!
        </div>
    </div>
</div>

<!-- Modal Tambah ke Keranjang -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <i class="fas fa-check-circle text-success mb-3" style="font-size: 50px;"></i>
                <h5 class="mb-3">Produk berhasil ditambahkan ke keranjang!</h5>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        Lanjut Belanja
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-primary px-4">
                        Lihat Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => data[key] = value);

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            // Tampilkan modal sukses
            const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));
            modal.show();
            
            // Refresh halaman setelah modal ditutup
            document.getElementById('addToCartModal').addEventListener('hidden.bs.modal', function () {
                window.location.reload();
            });
        })
        .catch(error => {
            console.error('Error:', error);
            const toast = new bootstrap.Toast(document.getElementById('cartToast'));
            document.querySelector('#cartToast .toast-body').textContent = 'Gagal menambahkan produk ke keranjang.';
            toast.show();
        });
    });
});
</script>
@endsection