@extends('public.layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Keranjang Belanja</h4>

    @if(isset($carts) && count($carts) > 0)
    <div class="card mb-4">
        <div class="card-body">
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
                        @php $totalPrice = 0; @endphp
                        @foreach($carts as $cart)
                        <tr data-cart-id="{{ $cart->id }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                    <span>{{ $cart->product->name }}</span>
                                </div>
                            </td>
                            <td>Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td style="width: 150px;">
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity({{ $cart->id }}, -1)">-</button>
                                    <input type="number" class="form-control text-center" value="{{ $cart->quantity }}" min="1" readonly>
                                    <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity({{ $cart->id }}, 1)">+</button>
                                </div>
                            </td>
                            <td>Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeFromCart({{ $cart->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @php $totalPrice += ($cart->product->price * $cart->quantity); @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Checkout Section -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('product') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                    </a>
                </div>
                <div class="text-end">
                    <div class="mb-2">
                        <span class="me-3">Total Pesanan:</span>
                        <span class="h5 mb-0 text-danger">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-danger px-5" style="background-color: #ee4d2d; border-color: #ee4d2d;">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-shopping-cart mb-3" style="font-size: 48px; color: #ccc;"></i>
        <h5>Keranjang Belanja Kosong</h5>
        <p class="text-muted">Yuk mulai belanja!</p>
        <a href="{{ route('product') }}" class="btn btn-primary">Mulai Belanja</a>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
async function updateQuantity(cartId, change) {
    try {
        const input = document.querySelector(`input[type="number"][value="${cartId}"]`).closest('tr').querySelector('input[type="number"]');
        const newQuantity = parseInt(input.value) + change;
        if (newQuantity < 1) return;

        const response = await fetch(`/cart/${cartId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                quantity: newQuantity
            })
        });

        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal mengupdate jumlah produk');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate jumlah produk');
    }
}

async function removeFromCart(cartId) {
    if (!confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) return;

    try {
        const response = await fetch(`/cart/${cartId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal menghapus produk dari keranjang');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus produk dari keranjang');
    }
}
</script>
@endsection 