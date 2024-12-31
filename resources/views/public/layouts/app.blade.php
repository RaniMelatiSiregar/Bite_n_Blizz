<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bite n Blizz</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* Navbar Styles */
        .navbar {
            padding: 1rem 0;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ee4d2d !important;
        }

        .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #ee4d2d;
        }

        .nav-icons {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-icons a {
            color: #333;
            font-size: 1.2rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-icons a:hover {
            color: #ee4d2d;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ee4d2d;
            color: white;
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            min-width: 1.5rem;
            text-align: center;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: #333;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #ee4d2d;
        }

        .dropdown-item.text-danger:hover {
            background-color: #fee;
        }

        /* Content Styles */
        .container {
            padding: 2rem 1rem;
        }

        /* Product Card Styles */
        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-danger {
            background-color: #ee4d2d;
            border-color: #ee4d2d;
        }

        .btn-danger:hover {
            background-color: #d73211;
            border-color: #d73211;
        }

        .btn-primary {
            background-color: #ee4d2d;
            border-color: #ee4d2d;
        }

        .btn-primary:hover {
            background-color: #d73211;
            border-color: #d73211;
        }

        .btn-outline-primary {
            color: #ee4d2d;
            border-color: #ee4d2d;
        }

        .btn-outline-primary:hover {
            background-color: #ee4d2d;
            border-color: #ee4d2d;
        }

        .text-primary {
            color: #ee4d2d !important;
        }

        .bg-primary {
            background-color: #ee4d2d !important;
        }

        /* Modal Styles */
        .modal-success-icon {
            color: #ee4d2d;
            font-size: 70px;
        }

        .modal-success-title {
            color: #ee4d2d;
            font-size: 1.75rem;
            font-weight: 600;
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Bite n Blizz</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">contact</a>
                    </li>
                </ul>

                <div class="nav-icons">
                    <a href="{{ route('cart.index') }}" class="position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        @auth
                            @if(session()->has('cart_count') && session('cart_count') > 0)
                                <span class="cart-badge">{{ session('cart_count') }}</span>
                            @endif
                        @endauth
                    </a>

                    @auth
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center text-decoration-none text-dark" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user-circle me-2"></i>Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline-danger">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <!-- About Column -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Bite n Blizz</h5>
                    <p class="text-muted">Toko kue yang menyajikan berbagai macam kue dengan cita rasa yang lezat dan tampilan yang menarik.</p>
                    <div class="social-links mt-3">
                        <a href="https://instagram.com/bitenblizz" target="_blank" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="text-white me-3"><i class="fab fa-whatsapp fa-lg"></i></a>
                        <a href="mailto:info@bitenblizz.com" class="text-white"><i class="far fa-envelope fa-lg"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('product') }}" class="text-muted text-decoration-none">Product</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-muted text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-muted text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Kontak Kami</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Depok, Sleman, Yogyakarta</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +62 812-3456-7890</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> @bitenblizz.com</li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row mt-4">
                <div class="col-12">
                    <hr class="bg-secondary">
                    <p class="text-center text-muted mb-0">
                        &copy; {{ date('Y') }} Bite n Blizz. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 