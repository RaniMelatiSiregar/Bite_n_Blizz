@extends('public.layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
        <h2 class="mt-4">Pesanan Berhasil!</h2>
        <p class="text-muted">Nomor Pesanan: {{ $order->order_number }}</p>
        <p>Total Pembayaran: <span class="text-danger">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
        <div class="mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-primary">
                <i class="fas fa-list me-2"></i>Lihat Pesanan Saya
            </a>
            <a href="{{ route('product') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-shopping-cart me-2"></i>Lanjut Belanja
            </a>
        </div>
    </div>
</div>
@endsection 