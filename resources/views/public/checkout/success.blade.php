@extends('public.layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
        <h4 class="mt-4">Pesanan Berhasil Dibuat!</h4>
        <p class="text-muted">Nomor Pesanan: #{{ $order->order_number }}</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Detail Pengiriman</h5>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Alamat Pengiriman</div>
                        <div class="col-md-8">{{ $order->address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Nomor Telepon</div>
                        <div class="col-md-8">{{ $order->phone }}</div>
                    </div>
                    @if($order->notes)
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Catatan</div>
                        <div class="col-md-8">{{ $order->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Detail Pembayaran</h5>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Total Pembayaran</div>
                        <div class="col-md-8 text-danger fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Status Pembayaran</div>
                        <div class="col-md-8">
                            <span class="badge bg-success">Berhasil</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">Kembali ke Beranda</a>
                <a href="{{ route('orders.index') }}" class="btn btn-danger" style="background-color: #ee4d2d; border-color: #ee4d2d;">
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 