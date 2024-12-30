<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    @include('public.layouts.header')

  <!-- Favorites Section -->
<h2 class="mb-4">Your Favorite Products</h2>
<div class="row">
    {{-- @foreach($favorites as $favorite) --}}
        <div class="col-md-3 col-sm-6 col-12 mb-4">
            <div class="card product-card">
                <img src="{{ asset('images/pisang.jpg') }}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">Banana Crispy</h5>
                    <p class="card-text">Rp 70.000</p>
                    <a href="/product/details" class="btn btn-primary">Details</a>
                    <a href="/favorite/remove" class="btn btn-danger">Remove</a>
                </div>
            </div>
        </div>
    {{-- @endforeach --}}
    {{-- Repeat the above block for the next product --}}
    <div class="col-md-3 col-sm-6 col-12 mb-4">
        <div class="card product-card">
            <img src="{{ asset('images/bananaCake.png') }}" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">Banana Cake</h5>
                <p class="card-text">Rp 90.000</p>
                <a href="/product/details" class="btn btn-primary">Details</a>
                <a href="/favorite/remove" class="btn btn-danger">Remove</a>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
</div>


    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{-- {{ $favorites->links() }} --}}
    </div>
</div>

<footer class="py-5">
    @include('public.layouts.footer')
</footer>
<div id="footer-bottom">
<div class="container-lg">
    <div class="row">
    <div class="col-md-6 copyright">
        <p>&copy; 2024 Bite n Bliezz. All rights reserved.</p>
    </div>
    <div class="col-md-6 credit-link text-start text-md-end">
        <!-- Optional footer credits -->
    </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
