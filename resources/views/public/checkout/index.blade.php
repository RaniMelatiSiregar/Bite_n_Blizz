@extends('public.layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Checkout</h4>

    @if(isset($carts) && count($carts) > 0)
    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Form Alamat -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Alamat Pengiriman</h5>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Detail Pesanan -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Detail Pesanan</h5>
                        @foreach($carts as $cart)
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="me-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                <p class="mb-1">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                <p class="mb-0 text-danger">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Harga</span>
                            <span class="text-danger">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total Tagihan</span>
                            <span class="fw-bold text-danger">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                        <input type="hidden" name="total_amount" value="{{ $totalPrice }}">
                        <button type="submit" class="btn btn-danger w-100" style="background-color: #ee4d2d; border-color: #ee4d2d;">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="text-center py-5">
        <h5>Tidak ada item untuk checkout</h5>
        <a href="{{ route('product') }}" class="btn btn-primary mt-3">Kembali Belanja</a>
    </div>
    @endif
</div>
@endsection 