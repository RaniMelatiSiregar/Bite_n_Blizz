@extends('public.layouts.app')

@section('content')
<div class="container-fluid bg-light py-4">
    <div class="container">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Pesanan Saya</h4>
            <a href="{{ route('product.index') }}" class="btn btn-danger">
                <i class="fas fa-shopping-bag me-2"></i>Belanja Lagi
            </a>
        </div>

        <!-- Filter Status -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="nav nav-pills">
                    <a class="nav-link {{ !$currentStatus ? 'active' : '' }}" href="{{ route('orders.index') }}">Semua</a>
                    <a class="nav-link {{ $currentStatus == 'pending' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'pending']) }}">Belum Bayar</a>
                    <a class="nav-link {{ $currentStatus == 'processing' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'processing']) }}">Diproses</a>
                    <a class="nav-link {{ $currentStatus == 'completed' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'completed']) }}">Selesai</a>
                    <a class="nav-link {{ $currentStatus == 'cancelled' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'cancelled']) }}">Dibatalkan</a>
                </div>
            </div>
        </div>

        <!-- Daftar Pesanan -->
    @forelse($orders as $order)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted me-2">{{ $order->created_at->format('d M Y H:i') }}</span>
                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="text-end">
                    <span class="text-muted me-2">No. Pesanan: {{ $order->order_number }}</span>
                </div>
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

            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted me-2">Total Pesanan:</span>
                        <span class="text-danger fw-bold">Rp {{ number_format($order->total_amount + $order->shipping_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-danger">
                            Lihat Detail
                        </a>
    
                        @if($order->status == 'processing')
                        <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                Pesanan Selesai
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <img src="{{ asset('images/empty-order.png') }}" alt="Empty Order" class="mb-4" style="max-width: 200px;">
            <h5>Belum ada pesanan</h5>
            <p class="text-muted mb-4">Yuk mulai belanja dan nikmati makanan lezat dari Bite n Blizz!</p>
            <a href="{{ route('product.index') }}" class="btn btn-danger">
                <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
            </a>
        </div>
    </div>
    @endforelse

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $orders->appends(['status' => $currentStatus])->links() }}
        </div>
    </div>
</div>

@push('styles')
<style>
:root {
    --shopee-color: #ee4d2d;
    --shopee-light: #fee7e1;
}

.nav-pills .nav-link {
    color: #6c757d;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    margin-right: 0.5rem;
}

.nav-pills .nav-link:hover {
    background-color: var(--shopee-light);
    color: var(--shopee-color);
}

.nav-pills .nav-link.active {
    background-color: var(--shopee-color);
    color: #fff;
}

.badge {
    padding: 0.5em 0.8em;
    border-radius: 4px;
}

.btn-danger {
    background-color: var(--shopee-color);
    border-color: var(--shopee-color);
}

.btn-danger:hover {
    background-color: #d73211;
    border-color: #d73211;
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    color: var(--shopee-color);
    padding: 0.5rem 1rem;
    border-radius: 4px;
    margin: 0 0.25rem;
}

.page-item.active .page-link {
    background-color: var(--shopee-color);
    border-color: var(--shopee-color);
}

.page-link:hover {
    background-color: var(--shopee-light);
    color: var(--shopee-color);
    border-color: #dee2e6;
}
</style>
@endpush
@endsection 