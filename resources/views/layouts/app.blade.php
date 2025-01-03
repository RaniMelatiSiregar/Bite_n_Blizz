<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Bite n Blizz') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: #dc3545;
        }
        
        .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #dc3545;
        }
        
        .nav-link.active {
            color: #dc3545;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
            min-width: 200px;
        }
        
        .dropdown-item {
            padding: 0.7rem 1.2rem;
            font-size: 0.9rem;
            color: #333;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            font-size: 1rem;
        }
        
        .dropdown-divider {
            margin: 0.3rem 0;
            opacity: 0.1;
        }
        
        .btn-logout {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 0.7rem 1.2rem;
            font-size: 0.9rem;
            color: #dc3545;
            display: flex;
            align-items: center;
        }
        
        .btn-logout i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            font-size: 1rem;
        }
        
        .btn-logout:hover {
            background-color: #f8f9fa;
        }
        
        .badge {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 50%;
        }
        
        .nav-item {
            position: relative;
            margin-right: 0.5rem;
        }
        
        .badge.bg-success {
            font-size: 0.7rem;
            padding: 0.35em 0.65em;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/LOGOO TOKO.jpg') }}" alt="Logo" height="40">
                Bite n Blizz
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}" href="{{ route('product.index') }}">
                            <i class="fas fa-utensils"></i> Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle"></i> Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="fas fa-envelope"></i> Kontak
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Daftar
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i> Keranjang
                                @if(Auth::user()->carts->count() > 0)
                                    <span class="badge bg-danger">{{ Auth::user()->carts->count() }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('affiliate.dashboard') }}">
                                <i class="fas fa-handshake"></i> Affiliate
                                @if(Auth::user()->affiliate)
                                    <span class="badge bg-success rounded-pill" style="position: absolute; top: -5px; right: -5px;">Aktif</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="fas fa-user me-2"></i> Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="fas fa-shopping-bag me-2"></i> Pesanan Saya
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn-logout">
                                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Bite n Blizz</h5>
                    <p class="text-muted">Nikmati kelezatan dalam setiap gigitan</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                        <li><a href="{{ route('product.index') }}" class="text-muted">Menu</a></li>
                        <li><a href="{{ route('about') }}" class="text-muted">Tentang</a></li>
                        <li><a href="{{ route('contact') }}" class="text-muted">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-phone me-2"></i> +62 123 4567 890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@bitenblizz.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Contoh No. 123, Kota</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted">
                <small>&copy; {{ date('Y') }} Bite n Blizz. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 