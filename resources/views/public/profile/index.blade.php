<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Products</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        @include('public.layouts.header')
    <div class="container my-5">
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4 text-center">
                <!-- Foto Profil -->
                <img src="https://via.placeholder.com/150" alt="User Photo" class="profile-photo mb-3">
                <h5>John Doe</h5>
                <p class="text-muted">john.doe@example.com</p>
            </div>
            <div class="col-md-8">
                <!-- Informasi Pribadi -->
                <h4 class="mb-4">Personal Information</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name:</th>
                            <td>John Doe</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>john.doe@example.com</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>+123 456 789</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>123 Main Street, City, Country</td>
                        </tr>
                        <tr>
                            <th>Joined:</th>
                            <td>January 1, 2023</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Tombol Edit Profile yang mengarah ke route edit -->
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
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
            <p>HTML Template by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a> </p>
        </div>
        </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const removeButtons = document.querySelectorAll('.remove-item');
            const cartTotal = document.getElementById('cart-total');
    
            const updateTotal = () => {
                let total = 0;
                document.querySelectorAll('tbody tr').forEach(row => {
                    const price = parseInt(row.children[2].textContent.replace(/Rp|\.|,/g, ''));
                    const quantity = parseInt(row.querySelector('.quantity-input').value);
                    const subtotal = price * quantity;
                    row.children[4].textContent = `Rp${subtotal.toLocaleString('id-ID')}`;
                    total += subtotal;
                });
                cartTotal.textContent = `Rp${total.toLocaleString('id-ID')}`;
            };
    
            quantityInputs.forEach(input => {
                input.addEventListener('input', updateTotal);
            });
    
            removeButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.target.closest('tr').remove();
                    updateTotal();
                });
            });
        });
    </script>
</body>
</html>
