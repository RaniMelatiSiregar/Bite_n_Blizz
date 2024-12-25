<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Bite n Bliezz</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/about.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    @include('public.layouts.header')

    <!-- About Us Section -->
    <section class="about-us">
        <div class="row align-items-center my-5">
            <div class="col-md-6 text-section">
                <h1 class="display-4 mb-4"><b>Kenali Bite n Bliezz</b></h1>
                <p class="lead">
                    Selamat datang di <strong>Bite n Bliezz</strong>, tempat di mana setiap dessert kami hadir dengan penuh cinta untuk menciptakan momen tak terlupakan. Kami adalah tim pembuat kue yang penuh semangat, berkomitmen untuk menyajikan kue dan pastry terbaik dengan bahan-bahan berkualitas tinggi.
                </p>
                <p>
                    Tujuan kami sederhana: menambah manisnya hidup Anda. Apakah Anda sedang merayakan momen spesial atau sekadar menikmati hidangan penutup di sore hari, setiap kreasi kami dirancang untuk memanjakan dan memuaskan selera. Mulai dari kue lezat hingga pastry kekinian, kami menyediakan berbagai pilihan untuk setiap kesempatan.
                </p>
                <p>
                    Di Bite n Bliezz, kami lebih dari sekadar toko dessert—kami adalah tempat di mana kebahagiaan dan rasa bertemu, menjadikan setiap gigitan sebuah perayaan.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/gambar3.png') }}" alt="Dessert Image" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="mission-section bg-light py-5">
        <div class="text-center">
            <h2 class="mb-4 text-primary">Misi Kami</h2>
            <p class="lead">
                Di Bite n Bliezz, misi kami sederhana: menyebarkan kebahagiaan melalui seni membuat kue. Kami percaya bahwa makanan memiliki kekuatan untuk menyatukan orang-orang, menciptakan kenangan abadi, dan membuat setiap momen terasa lebih manis.
            </p>
            <p>
                Bergabunglah dalam perjalanan kami untuk membuat dunia menjadi tempat yang lebih manis, melalui setiap kreasi lezat yang kami sajikan.
            </p>
        </div>
    </section>
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
</html>
