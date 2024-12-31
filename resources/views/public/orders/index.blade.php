@extends('public.layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Pesanan Saya</h4>

    <!-- Tab Status Pesanan -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                Semua
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'pending']) }}">
                Perlu Dikirim
                @if($pendingCount > 0)
                <span class="badge bg-danger ms-1">{{ $pendingCount }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'processing']) }}">
                Sedang Dikirim
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'completed']) }}">
                Selesai
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'cancelled' ? 'active' : '' }}" href="{{ route('orders.index', ['status' => 'cancelled']) }}">
                Dibatalkan
            </a>
        </li>
    </ul>

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="mb-1">Nomor Pesanan: #{{ $order->order_number }}</h6>
                        <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }} me-3">
                            {{ $order->status == 'pending' ? 'Perlu Dikirim' : 
                               ($order->status == 'processing' ? 'Sedang Dikirim' : 
                               ($order->status == 'completed' ? 'Selesai' : 'Dibatalkan')) }}
                        </span>
                        @if($order->status == 'pending')
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                Batalkan
                            </button>
                        </form>
                        @endif
                        @if($order->status == 'processing')
                        <form action="{{ route('orders.complete', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success">
                                Pesanan Diterima
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                @foreach($order->orderItems as $item)
                <div class="d-flex mb-3">
                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->product_name }}" class="me-3" style="width: 80px; height: 80px; object-fit: cover;">
                    <div>
                        <h6 class="mb-1">{{ $item->product_name }}</h6>
                        <p class="mb-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="mb-0 text-danger">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-2">Detail Pengiriman</h6>
                        <p class="mb-1">{{ $order->address }}</p>
                        <p class="mb-1">Telp: {{ $order->phone }}</p>
                        @if($order->notes)
                        <p class="mb-0 text-muted">Catatan: {{ $order->notes }}</p>
                        @endif
                    </div>
                    <div class="col-md-6 text-end">
                        <h6 class="mb-2">Total Pembayaran</h6>
                        <h5 class="text-danger">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="text-center py-5">
        <i class="fas fa-shopping-bag mb-3" style="font-size: 48px; color: #ccc;"></i>
        <h5>Belum ada pesanan</h5>
        <p class="text-muted">Yuk mulai belanja!</p>
        <a href="{{ route('product') }}" class="btn btn-primary">Mulai Belanja</a>
    </div>
    @endif
</div>

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
@endsection 