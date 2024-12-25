<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Bite n Bliezz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header -->
    @include('public.layouts.header')
    <header class="text-white py-5 text-center">
    <h1 class="display-4"><strong>Tentang Kami</strong></h1>
    <p class="lead">Bite n Bliezz - Lebih dari sekadar toko kue, kami menciptakan kenangan manis</p>
</header>

    <!-- About Us Section -->
    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Content -->
                <div class="col-md-6">
                    <h2 class="mb-4"><strong>Kenali Bite n Bliezz</strong></h2>
                    <p class="text-muted">
                        Selamat datang di <strong>Bite n Bliezz</strong>, tempat di mana setiap dessert kami hadir dengan cinta untuk menciptakan momen tak terlupakan. Kami menyajikan kue dan pastry terbaik dengan bahan-bahan berkualitas tinggi.
                    </p>
                    <p class="text-muted">
                        Mulai dari kue lezat hingga pastry kekinian, kami memiliki pilihan untuk setiap kesempatan. Di setiap gigitan, ada cerita yang manis, dan itulah yang membuat kami berbeda.
                    </p>
                </div>
                <!-- Image -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/gambar3.png') }}" alt="Dessert Image">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section bg-light py-5 text-center">
        <div class="container">
            <h2 class="text-primary mb-4">Misi Kami</h2>
            <p class="text-muted">
                Di Bite n Bliezz, misi kami adalah menyebarkan kebahagiaan melalui seni membuat kue. Kami percaya bahwa makanan memiliki kekuatan untuk menyatukan orang-orang dan menciptakan kenangan abadi.
            </p>
        </div>
    </section>

   
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