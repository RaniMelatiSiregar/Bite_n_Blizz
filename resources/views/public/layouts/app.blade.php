<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bite n Blizz') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        .footer {
            flex-shrink: 0;
            background-color: #2d3436;
            color: #fff;
            padding: 3rem 0;
            margin-top: 3rem;
        }
        .footer h5 {
            color: #ee4d2d;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .footer p, .footer a {
            color: #dfe6e9;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer a:hover {
            color: #ee4d2d;
        }
        .footer-social a {
            display: inline-block;
            width: 35px;
            height: 35px;
            background-color: #ee4d2d;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 35px;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        .footer-social a:hover {
            background-color: #fff;
            color: #ee4d2d;
        }
        .footer hr {
            border-color: #636e72;
            margin: 2rem 0;
        }
        .footer-bottom {
            text-align: center;
            color: #b2bec3;
            font-size: 0.9rem;
        }
        .alert-container {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 90%;
            max-width: 500px;
        }
        .alert {
            margin-bottom: 0;
            padding: 1.2rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
            border-radius: 10px;
        }
        .alert .btn-close {
            position: absolute;
            top: 0.8rem;
            right: 1rem;
        }
        .alert-success {
            background-color: #ee4d2d;
            color: white;
        }
        .alert-success .btn-light {
            color: #ee4d2d;
            border: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        .alert-success .btn-light:hover {
            background-color: #d63f21;
            color: white;
        }
        .alert-success .alert-heading {
            font-size: 1.1rem;
        }
        .alert-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    @include('public.layouts.navbar')

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert-container">
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <h4 class="alert-heading mb-2">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </h4>
            <div class="mt-3">
                <a href="{{ route('product.index') }}" class="btn btn-light me-2">
                    <i class="fas fa-shopping-bag me-2"></i>Lanjut Belanja
                </a>
                <a href="{{ route('cart.index') }}" class="btn btn-light">
                    <i class="fas fa-shopping-cart me-2"></i>Lihat Keranjang
                </a>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-container">
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <h4 class="alert-heading mb-0">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Tentang Kami -->
                <div class="col-md-4 mb-4">
                    <h5>Tentang Bite n Blizz</h5>
                    <p>Bite n Blizz adalah destinasi kuliner terbaik untuk pecinta makanan dan minuman. Kami menyajikan berbagai pilihan menu berkualitas dengan harga terjangkau.</p>
                    <div class="footer-social mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Link Cepat -->
                <div class="col-md-4 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('product.index') }}">Menu</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="col-md-4 mb-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                           Jl.Ringroud Utara,sleman ,Yogyakarta
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            +62 812-3456-7890
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@bitenblizz.com
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-clock me-2"></i>
                            Buka Setiap Hari: 10:00 - 22:00 WIB
                        </li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} Bite n Blizz. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto hide alert after 5 seconds (increased from 3 to give more time to click buttons)
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
    </script>
</body>
</html> 