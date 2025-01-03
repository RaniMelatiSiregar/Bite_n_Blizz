@extends('public.layouts.app')

@section('content')
<div class="container-fluid bg-light py-4">
    <div class="container">
        <!-- Logo dan Progress -->
        <div class="d-flex align-items-center mb-4">
            <img src="{{ asset('images/LOGOO TOKO.jpg') }}" alt="Logo" height="40" class="me-3">
            <div class="progress flex-grow-1" style="height: 4px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 33%"></div>
            </div>
        </div>

        <!-- Alert Error -->
        @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
        @endif

        <!-- Voucher -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-ticket-alt text-danger me-2"></i>
                    Voucher
                </h5>
                <form action="{{ route('checkout.apply-voucher') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="voucher_code" class="form-control" placeholder="Masukkan kode voucher" required>
                    <button type="submit" class="btn btn-danger">Pakai</button>
                </form>
                @if(session('voucher_error'))
                    <div class="text-danger mt-2">
                        {{ session('voucher_error') }}
                    </div>
                @endif
                @if(session('voucher_success'))
                    <div class="text-success mt-2">
                        {{ session('voucher_success') }}
                    </div>
                @endif
                @if(session('active_voucher'))
                    <div class="alert alert-success mt-3 mb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ session('active_voucher')->code }}</strong>
                                <br>
                                <small>Diskon {{ session('active_voucher')->discount }}%</small>
                            </div>
                            <form action="{{ route('checkout.remove-voucher') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-link text-danger p-0">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Form Checkout -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Alamat Pengiriman -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3 d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                            <h5 class="card-title mb-0">Alamat Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label small">Nama Penerima<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name', Auth::user()->name ?? '') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label small">No. Telepon<span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                    value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-0">
                                <label class="form-label small">Alamat Lengkap<span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                    rows="3" required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Mohon isi alamat selengkap mungkin (nama jalan, RT/RW, kelurahan, kecamatan, kota/kabupaten, provinsi, kode pos)
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produk yang Dibeli -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3 d-flex align-items-center">
                            <i class="fas fa-shopping-bag text-danger me-2"></i>
                            <h5 class="card-title mb-0">Produk yang Dibeli</h5>
                        </div>
                        <div class="card-body p-0">
                            @foreach($cartItems as $cart)
                            <div class="d-flex align-items-center p-3 border-bottom">
                                <img src="{{ asset('storage/' . $cart->product->image) }}" 
                                    alt="{{ $cart->product->name }}" 
                                    class="rounded me-3"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                    <p class="mb-0 text-muted small">
                                        Variasi: Reguler
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="text-danger">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</span>
                                        <span class="text-muted">Qty: {{ $cart->quantity }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Catatan -->
                            <div class="p-3 border-bottom bg-light">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-truck text-danger me-2"></i>
                                    <span>Pengiriman</span>
                                    <span class="ms-auto">Rp {{ number_format($shipping_fee, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metode Pembayaran -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3 d-flex align-items-center">
                            <i class="fas fa-wallet text-danger me-2"></i>
                            <h5 class="card-title mb-0">Metode Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="payment-method mb-3">
                                <input type="radio" class="btn-check" name="payment_method" id="transfer" value="transfer" checked>
                                <label class="btn btn-outline-danger w-100 text-start position-relative" for="transfer">
                                    <i class="fas fa-university me-2"></i>
                                    Transfer Bank
                                    <small class="d-block text-muted mt-1">Transfer ke rekening BCA: 1234567890 a.n Bite n Blizz</small>
                                    <i class="fas fa-check-circle position-absolute top-50 end-3 translate-middle-y text-success" style="display: none;"></i>
                                </label>
                            </div>
                            
                            <div class="payment-method">
                                <input type="radio" class="btn-check" name="payment_method" id="cod" value="cod">
                                <label class="btn btn-outline-danger w-100 text-start position-relative" for="cod">
                                    <i class="fas fa-hand-holding-usd me-2"></i>
                                    Cash on Delivery (COD)
                                    <small class="d-block text-muted mt-1">Bayar saat pesanan sampai</small>
                                    <i class="fas fa-check-circle position-absolute top-50 end-3 translate-middle-y text-success" style="display: none;"></i>
                                </label>
                            </div>
                            @error('payment_method')
                            <div class="text-danger mt-2 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 2rem;">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Harga ({{ $cartItems->count() }} Produk)</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Ongkos Kirim</span>
                                <span>Rp {{ number_format($shipping_fee, 0, ',', '.') }}</span>
                            </div>

                            @if(session('active_voucher'))
                            <div class="d-flex justify-content-between mb-3 text-success">
                                <span>
                                    <i class="fas fa-ticket-alt me-1"></i>
                                    Diskon Voucher ({{ session('active_voucher')->discount }}%)
                                </span>
                                <span>-Rp {{ number_format($discount_amount, 0, ',', '.') }}</span>
                            </div>
                            @endif

                            <hr>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Total Belanja</span>
                                <span class="fw-bold text-danger fs-5">
                                    Rp {{ number_format($final_total, 0, ',', '.') }}
                                </span>
                            </div>

                            <button type="submit" class="btn btn-danger w-100 btn-lg fw-bold">
                                Buat Pesanan
                            </button>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Pembayaran Aman & Terjamin
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
:root {
    --shopee-color: #ee4d2d;
    --shopee-light: #fee7e1;
}

.bg-shopee {
    background-color: var(--shopee-color) !important;
}

.text-shopee {
    color: var(--shopee-color) !important;
}

.progress {
    background-color: #efefef;
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar {
    background-color: var(--shopee-color);
    transition: width 0.3s ease;
}

.card {
    border-radius: 4px;
    overflow: hidden;
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid rgba(0,0,0,.05);
}

.form-control {
    border-radius: 4px;
    border-color: #ddd;
    padding: 0.6rem 1rem;
}

.form-control:focus {
    border-color: var(--shopee-color);
    box-shadow: 0 0 0 0.2rem rgba(238, 77, 45, 0.15);
}

.payment-method {
    margin-bottom: 1rem;
}

.payment-method label {
    padding: 1rem;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.payment-method .btn-check:checked + label {
    background-color: var(--shopee-light);
    border-color: var(--shopee-color);
}

.payment-method .btn-check:checked + label .fa-check-circle {
    display: block !important;
}

.btn-danger {
    background-color: var(--shopee-color);
    border-color: var(--shopee-color);
}

.btn-danger:hover {
    background-color: #d73211;
    border-color: #d73211;
}

.btn-outline-danger {
    color: var(--shopee-color);
    border-color: #ddd;
}

.btn-outline-danger:hover {
    background-color: var(--shopee-light);
    border-color: var(--shopee-color);
    color: var(--shopee-color);
}

.end-3 {
    right: 1rem !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan centang saat metode pembayaran dipilih
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            document.querySelectorAll('.payment-method .fa-check-circle').forEach(icon => {
                icon.style.display = 'none';
            });
            this.nextElementSibling.querySelector('.fa-check-circle').style.display = 'block';
        });
    });

    // Tampilkan centang pada metode pembayaran default
    document.querySelector('input[name="payment_method"]:checked')
        .nextElementSibling.querySelector('.fa-check-circle').style.display = 'block';

    // Animasi loading saat submit
    const form = document.querySelector('form[action="{{ route('checkout.store') }}"]');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        if (form.checkValidity()) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
        }
    });
});
</script>
@endpush
@endsection 