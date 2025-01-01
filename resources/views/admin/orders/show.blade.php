@extends('admin.layouts.index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart"></i> Transaksi
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Detail Transaksi #{{ $order->id }}</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Detail Transaksi #{{ $order->id }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user mr-2"></i>
                                        Informasi Pelanggan
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <tr>
                                            <th width="30%">Nama</th>
                                            <td>: {{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: {{ $order->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. Telepon</th>
                                            <td>: {{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $order->address }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Informasi Transaksi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <tr>
                                            <th width="30%">Status</th>
                                            <td>
                                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" class="form-control status-select" onchange="this.form.submit()">
                                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>: {{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>: <span class="text-primary font-weight-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-shopping-basket mr-2"></i>
                                Detail Produk
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <i class="fas fa-box mr-2"></i>
                                                {{ $item->product->nama_produk }}
                                            </td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                <span class="text-primary font-weight-bold">
                                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="3" class="text-right">Total</th>
                                            <th>
                                                <span class="text-primary font-weight-bold">
                                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                </span>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .status-select {
        min-width: 120px;
    }
    .card-header {
        padding: 0.75rem 1.25rem;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endpush 