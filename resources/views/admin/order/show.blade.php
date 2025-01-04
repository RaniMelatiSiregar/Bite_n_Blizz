@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pesanan #{{ $orders->id }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Pesanan</a></li>
                        <li class="breadcrumb-item active">Detail Pesanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pesanan</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="width:200px">ID Pesanan</th>
                                    <td>#{{ $orders->id }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pesanan</th>
                                    <td>{{ $orders->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pesanan</th>
                                    <td>
                                        <form action="{{ route('admin.order.update-status', $orders->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control d-inline" style="width: 200px" onchange="this.form.submit()">
                                                <option value="pending" {{ $orders->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $orders->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ $orders->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $orders->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>
                                        <form action="{{ route('admin.order.update-payment', $orders->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="payment_status" value="{{ $orders->payment_status === 'paid' ? 'unpaid' : 'paid' }}">
                                            @if($orders->payment_status == 'paid')
                                                <span class="badge badge-success">Sudah Dibayar</span>
                                                <br>
                                                <small class="text-muted">{{ $orders->paid_at ? $orders->paid_at->format('d M Y H:i') : '' }}</small>
                                                <button type="submit" class="btn btn-sm btn-warning ml-2" onclick="return confirm('Yakin ingin mengubah status menjadi belum dibayar?')">
                                                    <i class="fas fa-times"></i> Tandai Belum Dibayar
                                                </button>
                                            @else
                                                <span class="badge badge-warning">Belum Dibayar</span>
                                                <button type="submit" class="btn btn-sm btn-success ml-2" onclick="return confirm('Konfirmasi pembayaran pesanan ini?')">
                                                    <i class="fas fa-check"></i> Konfirmasi Pembayaran
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Metode Pembayaran</th>
                                    <td>{{ strtoupper($orders->payment_method) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pelanggan</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th style="width:200px">Nama</th>
                                    <td>{{ $orders->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $orders->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>{{ $orders->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Pengiriman</th>
                                    <td>{{ $orders->shipping_address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Produk</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ Storage::url($item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="img-thumbnail mr-2"
                                                         style="max-height: 50px">
                                                    {{ $item->product->name }}
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                                        <td>Rp {{ number_format($orders->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Ongkos Kirim</strong></td>
                                        <td>Rp {{ number_format($orders->shipping_cost, 0, ',', '.') }}</td>
                                    </tr>
                                    @if($orders->discount > 0)
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Diskon</strong></td>
                                            <td>-Rp {{ number_format($orders->discount, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                                        <td><strong>Rp {{ number_format($orders->total, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto hide alerts
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 3000);
</script>
@endpush 