@extends('public.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Keranjang Belanja</h2>
                <a href="{{ route('product.index') }}" class="btn btn-outline-danger">
                    <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                </a>
            </div>

            @if($carts->isEmpty())
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                </div>
                <h4>Keranjang Belanja Kosong</h4>
                <p class="text-muted">Anda belum menambahkan produk apapun ke keranjang.</p>
                <a href="{{ route('product.index') }}" class="btn btn-danger">
                    <i class="fas fa-shopping-cart me-2"></i>Mulai Belanja
                </a>
            </div>
            @else
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @foreach($carts as $cart)
                    <div class="d-flex align-items-center p-3 border-bottom">
                        <img src="{{ asset('storage/' . $cart->product->image) }}" 
                            alt="{{ $cart->product->name }}" 
                            class="rounded me-3"
                            style="width: 80px; height: 80px; object-fit: cover;">
                        
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $cart->product->name }}</h5>
                            <p class="mb-0 text-danger fw-bold">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="input-group me-3" style="width: 120px;">
                                <button type="button" class="btn btn-outline-secondary update-quantity" 
                                    data-cart-id="{{ $cart->id }}" 
                                    data-action="decrease">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center quantity-input" 
                                    value="{{ $cart->quantity }}" min="1" 
                                    data-cart-id="{{ $cart->id }}">
                                <button type="button" class="btn btn-outline-secondary update-quantity" 
                                    data-cart-id="{{ $cart->id }}" 
                                    data-action="increase">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <form action="{{ route('cart.remove', $cart) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        @if(!$carts->isEmpty())
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 2rem;">
                <div class="card-body">
                    <h5 class="card-title mb-4">Ringkasan Belanja</h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Harga ({{ $carts->count() }} Produk)</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Ongkos Kirim</span>
                        <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total Belanja</span>
                        <span class="fw-bold text-danger fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('checkout.index') }}" method="GET">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update quantity buttons
    document.querySelectorAll('.update-quantity').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.dataset.cartId;
            const action = this.dataset.action;
            const input = document.querySelector(`input[data-cart-id="${cartId}"]`);
            let quantity = parseInt(input.value);

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }

            if (quantity >= 1) {
                updateCartQuantity(cartId, quantity);
            }
        });
    });

    // Update quantity on input change
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const cartId = this.dataset.cartId;
            const quantity = parseInt(this.value);

            if (quantity >= 1) {
                updateCartQuantity(cartId, quantity);
            }
        });
    });

    function updateCartQuantity(cartId, quantity) {
        fetch(`/cart/update/${cartId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengubah jumlah produk');
        });
    }
});
</script>
@endpush

@push('styles')
<style>
.quantity-input {
    width: 50px;
    text-align: center;
}

.quantity-input::-webkit-inner-spin-button,
.quantity-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.sticky-top {
    z-index: 1020;
}
</style>
@endpush
@endsection 