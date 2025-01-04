@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pesanan</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Semua Pesanan</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Cari...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>No. Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Menunggu</span>
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
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" 
                                                class="btn btn-sm btn-secondary dropdown-toggle" 
                                                data-toggle="dropdown">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <form action="{{ route('admin.order.update-status', $order->id) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="processing">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-clock text-info"></i> Proses Pesanan
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.order.update-status', $order->id) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-check text-success"></i> Selesaikan
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.order.update-status', $order->id) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-times text-danger"></i> Batalkan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
.table td, .table th {
    vertical-align: middle;
}
.dropdown-item {
    cursor: pointer;
}
.dropdown-item:hover {
    background-color: #f8f9fa;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Pencarian
    $('input[name="table_search"]').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        $('tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1)
        });
    });

    // Auto-hide alert
    setTimeout(function() {
        $('.alert').alert('close');
    }, 3000);
});
</script>
@endpush
@endsection 