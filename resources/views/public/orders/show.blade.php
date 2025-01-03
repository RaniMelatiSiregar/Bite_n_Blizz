@extends('public.layouts.app')

@section('content')
<div class="container-fluid bg-light py-4">
    <div class="container">
        <!-- Header -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('orders.index') }}" class="btn btn-link text-dark p-0 me-3">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h4 class="mb-0">Detail Pesanan</h4>
        </div>

        <!-- Status Pesanan -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-box text-danger fa-2x"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mb-1">{{ ucfirst($order->status) }}</h5>
                        <p class="mb-0 text-muted">
                            Nomor Pesanan: {{ $order->order_number }}
                        </p>
                    </div>
                </div>

                <!-- Timeline Status -->
                <div class="timeline">
                    <div class="timeline-item {{ in_array($order->status, ['pending', 'processing', 'completed']) ? 'active' : '' }}">
                        <div class="timeline-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Pesanan Dibuat</h6>
                            <small>{{ $order->created_at->format('d M Y H:i') }}</small>
                        </div>
                    </div>

                    <div class="timeline-item {{ in_array($order->status, ['processing', 'completed']) ? 'active' : '' }}">
                        <div class="timeline-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Pesanan Diproses</h6>
                            <small>{{ $order->status == 'pending' ? '-' : $order->updated_at->format('d M Y H:i') }}</small>
                        </div>
                    </div>

                    <div class="timeline-item {{ $order->status == 'completed' ? 'active' : '' }}">
                        <div class="timeline-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h6>Pesanan Selesai</h6>
                            <small>{{ $order->status == 'completed' ? $order->updated_at->format('d M Y H:i') : '-' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Alamat Pengiriman -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                            <h5 class="card-title mb-0">Alamat Pengiriman</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6>{{ $order->shipping_name }}</h6>
                        <p class="mb-0">{{ $order->shipping_phone }}</p>
                        <p class="mb-0">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <!-- Produk -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shopping-bag text-danger me-2"></i>
                            <h5 class="card-title mb-0">Produk</h5>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @foreach($order->orderItems as $item)
                        <div class="d-flex align-items-center p-3 border-bottom">
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                alt="{{ $item->product->name }}" 
                                class="rounded me-3"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $item->product->name }}</h6>
                                <p class="mb-0 text-muted small">
                                    Variasi: Reguler
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="text-danger">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    <span class="text-muted">Qty: {{ $item->quantity }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Info Pengiriman -->
                        <div class="p-3 border-bottom bg-light">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-truck text-danger me-2"></i>
                                <span>Pengiriman</span>
                                <span class="ms-auto">Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Pembayaran -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-wallet text-danger me-2"></i>
                            <h5 class="card-title mb-0">Pembayaran</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Metode Pembayaran</span>
                            <span class="text-uppercase">{{ $order->payment_method }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Status Pembayaran</span>
                            <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ $order->payment_status == 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                            </span>
                        </div>

                        @if($order->payment_method == 'transfer' && $order->payment_status == 'unpaid')
                        <div class="alert alert-light border mb-0">
                            <h6 class="mb-2">Instruksi Pembayaran:</h6>
                            <p class="mb-2">Transfer ke rekening:</p>
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('images/bca.png') }}" alt="BCA" height="30" class="me-2">
                                <div>
                                    <p class="mb-0 fw-bold">1234567890</p>
                                    <small>a.n Bite n Blizz</small>
                                </div>
                                <button class="btn btn-sm btn-outline-dark ms-auto" onclick="copyToClipboard('1234567890')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <p class="mb-2">Nominal Transfer:</p>
                            <div class="d-flex align-items-center">
                                <h5 class="text-danger mb-0">Rp {{ number_format($order->total_amount + $order->shipping_fee, 0, ',', '.') }}</h5>
                                <button class="btn btn-sm btn-outline-dark ms-auto" onclick="copyToClipboard('{{ $order->total_amount + $order->shipping_fee }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Total Harga ({{ $order->orderItems->count() }} Produk)</span>
                            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Total Ongkos Kirim</span>
                            <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                        </div>

                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Belanja</span>
                            <span class="fw-bold text-danger fs-5">
                                Rp {{ number_format($order->total_amount + $order->shipping_fee, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
:root {
    --shopee-color: #ee4d2d;
    --shopee-light: #fee7e1;
}

.timeline {
    position: relative;
    padding: 20px 0 0;
}

.timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 15px;
    height: 100%;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    padding-left: 45px;
    padding-bottom: 20px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-icon {
    position: absolute;
    left: 0;
    top: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.timeline-item.active .timeline-icon {
    background: var(--shopee-color);
    border-color: var(--shopee-color);
    color: #fff;
}

.timeline-content {
    padding-bottom: 10px;
}

.timeline-content h6 {
    margin-bottom: 5px;
}

.timeline-content small {
    color: #6c757d;
}

.btn-link {
    text-decoration: none;
}

.btn-link:hover {
    color: var(--shopee-color) !important;
}

.badge {
    padding: 0.5em 0.8em;
    border-radius: 4px;
}
</style>
@endpush

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Berhasil disalin!');
    }).catch(err => {
        console.error('Gagal menyalin teks: ', err);
    });
}
</script>
@endpush
@endsection 