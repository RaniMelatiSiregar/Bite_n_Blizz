<!-- Header -->
<header class="sticky-top">
    <!-- Top Bar -->
    <div class="bg-danger text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>+62 812-3456-7890</span>
                        <span class="mx-3">|</span>
                        <i class="fas fa-envelope mr-2"></i>
                        <span>info@bitenblizz.com</span>
                    </div>
                </div>
                <div class="col-md-6 text-md-right">
                    <div class="d-flex align-items-center justify-content-md-end">
                        <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light py-3">
                <!-- Logo -->
                <a class="navbar-brand mx-auto brand-text" href="{{ route('home') }}">
                    Bite n' Blizz
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                            <a class="nav-link px-4" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('product.*') ? 'active' : '' }}">
                            <a class="nav-link px-4" href="{{ route('product.index') }}">Menu</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                            <a class="nav-link px-4" href="{{ route('about') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                            <a class="nav-link px-4" href="{{ route('contact') }}">Kontak</a>
                        </li>
                    </ul>

                    <!-- Right Menu -->
                    <div class="navbar-nav ml-auto">
                        @auth
                            <a href="{{ route('cart.index') }}" class="nav-link position-relative mr-3">
                                <i class="fas fa-shopping-cart"></i>
                                @if(isset($cartCount) && $cartCount > 0)
                                    <span class="badge badge-danger badge-pill position-absolute" style="top: 0; right: -5px;">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                                         class="rounded-circle mr-2" 
                                         alt="Profile"
                                         width="30">
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="fas fa-shopping-bag mr-2"></i>Pesanan
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-danger mr-2">Masuk</a>
                            <a href="{{ route('register') }}" class="btn btn-danger">Daftar</a>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

@push('styles')
<style>
/* Header Styles */
header {
    font-family: 'Source Sans Pro', sans-serif;
}

/* Top Bar */
.bg-danger {
    background-color: #dc3545 !important;
}

/* Navbar */
.navbar-brand.brand-text {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #dc3545;
    text-transform: uppercase;
    letter-spacing: 2px;
    padding: 0;
    margin: 0 2rem;
    transition: all 0.3s ease;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.navbar-brand.brand-text:hover {
    transform: scale(1.05);
    color: #dc3545;
    text-decoration: none;
}

.nav-link {
    font-weight: 600;
    font-size: 1.1rem;
    padding: 0.5rem 1.5rem !important;
    transition: all 0.3s ease;
    position: relative;
}

.nav-item.active .nav-link {
    color: #dc3545 !important;
}

.nav-link:hover {
    color: #dc3545 !important;
}

.nav-item.active .nav-link::after,
.nav-link:hover::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 2px;
    background-color: #dc3545;
}

/* Dropdown */
.dropdown-item {
    padding: 0.7rem 1.5rem;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: #fff1f1;
}

.dropdown-item:active {
    background-color: #dc3545;
}

/* Cart Badge */
.badge-danger {
    font-size: 0.7rem;
    padding: 0.25em 0.5em;
}

/* Buttons */
.btn {
    padding: 0.6rem 1.8rem;
    font-weight: 600;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-outline-danger {
    border-width: 2px;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
    transform: translateY(-2px);
}

/* Social Icons */
.fab {
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.fab:hover {
    opacity: 0.8;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 991.98px) {
    .navbar-collapse {
        padding: 1rem 0;
        text-align: center;
    }
    
    .navbar-nav {
        margin: 1rem 0;
    }
    
    .navbar-nav.align-items-center {
        margin-top: 1rem;
        border-top: 1px solid rgba(0,0,0,.1);
        padding-top: 1rem;
    }

    .nav-link::after {
        display: none;
    }
}
</style>

@push('scripts')
<script>
    // Tambahkan font Playfair Display dari Google Fonts
    document.head.innerHTML += '<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">';
</script>
@endpush 