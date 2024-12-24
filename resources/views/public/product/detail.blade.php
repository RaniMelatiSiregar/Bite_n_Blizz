<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    @include('public.layouts.header')
    <div class="container mt-5">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-6">
                <img src="{{ asset('images/product1.jpg') }}" alt="Nama Produk" class="img-fluid product-image">
            </div>
            
            <!-- Detail Produk -->
            <div class="col-md-6">
                <h2>Nama Produk</h2>
                <p class="text-muted">Kategori Produk</p>
                <p>Deskripsi lengkap mengenai produk ini. Produk ini memiliki fitur unggulan yang akan memudahkan Anda dalam penggunaannya.</p>
                <h4 class="text-dark"><b>Rp 1.500.000</b></h4>

                <div class="form-group mt-4">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-4">
                    <form action="#" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-custom">Tambah ke Keranjang</button>
                    </form>
                    
                    <form action="#" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-custom">Tambah ke Favorit</button>
                    </form>

                    <form action="#" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-success btn-custom">Beli Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5">
        @include('public.layouts.footer')
    </footer>
    <div id="footer-bottom">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p>© 2024 Organic. All rights reserved.</p>
                </div>
                <div class="col-md-6 credit-link text-start text-md-end">
                    <p>HTML Template by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
