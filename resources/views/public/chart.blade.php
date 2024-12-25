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
</head>
<body>
<div class="container mt-4">
    @include('public.layouts.header')
   
    <div class="container py-5">
        <h2 class="text-center mb-4">Keranjang Belanja</h2>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <!-- Data Statis -->
                    <tr>
                        <td>
                            <img src="https://via.placeholder.com/100" alt="Produk" class="img-thumbnail" style="width: 100px;">
                        </td>
                        <td>Produk 1</td>
                        <td>Rp100.000</td>
                        <td>
                            <input type="number" value="1" min="1" class="form-control quantity-input">
                        </td>
                        <td>Rp100.000</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-item"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="https://via.placeholder.com/100" alt="Produk" class="img-thumbnail" style="width: 100px;">
                        </td>
                        <td>Produk 2</td>
                        <td>Rp150.000</td>
                        <td>
                            <input type="number" value="2" min="1" class="form-control quantity-input">
                        </td>
                        <td>Rp300.000</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-item"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-right mt-4">
            <h4>Total: <span id="cart-total">Rp400.000</span></h4>
            <button class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Lanjut ke Checkout</button>
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
