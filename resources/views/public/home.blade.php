<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bite n' Blizz</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  </head>
  <body>

@include('public.layouts.header')

    <section style="background-image: url('images/banner.jpg'); background-repeat: no-repeat; background-size: cover; height: 100vh; display: flex; justify-content: center; align-items: center; text-align: center;">
      <div class="container-lg">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="display-1 ls-1"><span class="fw-bold text-primary">Bite N' Blizz</span></h2>
            <p class="fs-4">Delicious Dessert in Here</p>
          </div>
        </div>
      </div>
    </section>
    

    <section class="py-5 overflow-hidden">
      @include('public.layouts.Category')
    </section>

    <section class="pb-5">
    @include('public.layouts.Bestselling')
    </section>

    <section class="py-3">
    <div class="container-lg">
  <div class="row">
    <div class="col-md-12">
      <div class="banner-blocks">
        <div class="banner-ad d-flex align-items-center large bg-info block-1" 
          style="background: url('images/gambar4.png') no-repeat center; 
                 background-size: cover; 
                 width: 175%; 
                 height: 300px;"> <!-- Atur tinggi di sini -->
          <div class="banner-content p-5">
            <div class="content-wrapper text-light">
              <h3 class="banner-title text-light">Items on SALE</h3>
              <p>Discounts up to 30%</p>
              <a href="#" class="btn-link text-white">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    </section>

    <section id="latest-products" class="products-carousel">
      @include('public.layouts.product')
    </section>

        <!-- Download App Section -->
        <section class="pb-4 my-4">
          <div class="container-lg">
        
            <div class="bg-warning pt-5 rounded-5">
              <div class="container">
                <div class="row justify-content-center align-items-center">
                  <div class="col-md-4">
                    <h2 class="mt-5">Download Bite n' Blizz App</h2>
                    <p>Order your favorite Banana Choco Crispy with ease, fast, and reliable!</p>
                    <div class="d-flex gap-2 flex-wrap mb-5">
                      <a href="#" title="App store"><img src="images/img-app-store.png" alt="app-store"></a>
                      <a href="#" title="Google Play"><img src="images/img-google-play.png" alt="google-play"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </section>

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
            <p>HTML Template by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a> </p>
          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>