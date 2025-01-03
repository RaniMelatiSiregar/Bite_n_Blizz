@extends('public.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Profile -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/profile/' . (Auth::user()->photo ?? 'default.jpg')) }}" 
                             alt="Profile" 
                             class="rounded-circle me-3"
                             style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2"></i> Profile Saya
                        </a>
                        <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action active">
                            <i class="fas fa-shopping-bag me-2"></i> Pesanan Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Pesanan -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Tab Status Pesanan -->
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                Semua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" 
                               href="{{ route('orders.index', ['status' => 'pending']) }}">
                                Belum Bayar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" 
                               href="{{ route('orders.index', ['status' => 'processing']) }}">
                                Diproses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" 
                               href="{{ route('orders.index', ['status' => 'completed']) }}">
                                Selesai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'cancelled' ? 'active' : '' }}" 
                               href="{{ route('orders.index', ['status' => 'cancelled']) }}">
                                Dibatalkan
                            </a>
                        </li>
                    </ul>

                    <!-- Daftar Pesanan -->
                    @forelse($orders as $order)
                    <div class="card mb-3 border">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted me-2">{{ $order->created_at->format('d M Y H:i') }}</span>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                        @switch($order->status)
                                            @case('pending')
                                                Belum Bayar
                                                @break
                                            @case('processing')
                                                Diproses
                                                @break
                                            @case('completed')
                                                Selesai
                                                @break
                                            @case('cancelled')
                                                Dibatalkan
                                                @break
                                        @endswitch
                                    </span>
                                </div>
                                <div>
                                    <span class="text-muted">No. Pesanan:</span>
                                    <span class="fw-bold">{{ $order->order_number }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            @foreach($order->items as $item)
                            <div class="d-flex mb-3">
                                <img src="{{ asset('images/products/' . basename($item->product->image)) }}" 
                                     alt="{{ $item->product->name }}"
                                     class="me-3"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <p class="mb-1 text-muted">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0 text-danger fw-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                            @endforeach
                        </div>

                        <div class="card-footer bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <span class="text-muted">Total Pesanan:</span>
                                    <span class="text-danger fw-bold ms-2">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-6 text-end">
                                    @if($order->status === 'pending')
                                        <button class="btn btn-sm btn-danger cancel-order" data-order-id="{{ $order->id }}">
                                            Batalkan
                                        </button>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            Bayar Sekarang
                                        </a>
                                    @endif
                                    @if($order->status === 'processing')
                                        <button class="btn btn-sm btn-success complete-order" data-order-id="{{ $order->id }}">
                                            Pesanan Diterima
                                        </button>
                                    @endif
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <img src="{{ asset('images/empty.svg') }}" alt="Tidak ada pesanan" class="mb-3" style="max-width: 200px;">
                        <h5 class="text-muted">Belum ada pesanan</h5>
                        <a href="{{ route('product') }}" class="btn btn-danger mt-3">Mulai Belanja</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.nav-tabs .nav-link {
    color: #666;
    border: none;
    border-bottom: 2px solid transparent;
    padding: 0.5rem 1rem;
}

.nav-tabs .nav-link.active {
    color: #ee4d2d;
    border: none;
    border-bottom: 2px solid #ee4d2d;
    background: none;
}

.nav-tabs .nav-link:hover {
    border-color: transparent;
    color: #ee4d2d;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cancel Order
    document.querySelectorAll('.cancel-order').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                const orderId = this.dataset.orderId;
                
                fetch(`/orders/${orderId}/cancel`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal membatalkan pesanan');
                });
            }
        });
    });

    // Complete Order
    document.querySelectorAll('.complete-order').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah pesanan sudah diterima?')) {
                const orderId = this.dataset.orderId;
                
                fetch(`/orders/${orderId}/complete`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengubah status pesanan');
                });
            }
        });
    });
});
</script>
@endpush
@endsection 