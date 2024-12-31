<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Bite n Bliezz</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('public.layouts.header')

    <div class="container mt-5">
        <h2 class="mb-4">Keranjang Belanja</h2>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" style="width: 50px; margin-right: 10px;">
                                        <span>{{ $details['name'] }}</span>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" style="width: 70px;" min="1">
                                </td>
                                <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm remove-item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="{{ url('/product') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Lanjut Belanja
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                    <form action="{{ route('checkout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
                <h3>Keranjang Belanja Kosong</h3>
                <p class="text-muted">Anda belum menambahkan produk apapun ke keranjang</p>
                <a href="{{ url('/product') }}" class="btn btn-primary">Mulai Belanja</a>
            </div>
        @endif
    </div>

    <footer class="py-5 mt-5">
        @include('public.layouts.footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
