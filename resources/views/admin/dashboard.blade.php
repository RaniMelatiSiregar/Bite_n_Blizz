@extends('admin.layouts.index')

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pesanan</span>
                    <span class="info-box-number">{{ $orderCount ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pendapatan</span>
                    <span class="info-box-number">Rp {{ number_format($revenue ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pelanggan</span>
                    <span class="info-box-number">{{ $userCount ?? 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Produk</span>
                    <span class="info-box-number">{{ $productCount ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pesanan Terbaru -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pesanan Terbaru</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders ?? [] as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @break
                                        @case('processing')
                                            <span class="badge badge-info">Diproses</span>
                                            @break
                                        @case('completed')
                                            <span class="badge badge-success">Selesai</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge badge-danger">Dibatalkan</span>
                                            @break
                                        @default
                                            <span class="badge badge-secondary">{{ $order->status }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pesanan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 