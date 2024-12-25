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

    <!-- All Products Section -->
    <h2 class="mb-4">All Products</h2>
    <div class="row">
        {{-- @foreach($products as $product) --}}
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="{{ asset('images/bananaCake.png') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Banana Cake</h5>
                        <p class="card-text">Rp 50.000</p>
                        <a href="/product/details" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{-- {{ $products->links() }} --}}
    </div>
</div>

<footer class="py-5">
    @include('public.layouts.footer')
</footer>
<div id="footer-bottom">
<div class="container-lg">
    <div class="row">
    <div class="col-md-6 copyright">
        <p>© 2024 Bite n Bliezz. All rights reserved.</p>
    </div>
    <div class="col-md-6 credit-link text-start text-md-end">
        <!-- <p>HTML Template by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a> </p> -->
    </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
