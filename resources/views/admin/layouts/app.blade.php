<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bite n Bliezz</title>
    
    <!-- AdminLTE Template -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .main-sidebar {
            background-color: #343a40;
            color: #fff;
        }
        
        .nav-sidebar .nav-link {
            color: #fff !important;
        }
        
        .nav-sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .nav-sidebar .nav-link.active {
            background-color: #007bff;
        }
        
        .nav-treeview .nav-link {
            padding-left: 2.5rem;
            font-size: 0.9rem;
        }
        
        .brand-link {
            border-bottom: 1px solid #4b545c;
        }
        
        .brand-link .brand-image {
            margin-top: -3px;
        }
        
        .content-wrapper {
            background-color: #f4f6f9;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('admin.layouts.menudashboard')
        </aside>

        <!-- Content -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    @stack('scripts')
</body>
</html> 