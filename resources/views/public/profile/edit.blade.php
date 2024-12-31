@extends('public.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-avatar.png') }}" 
                                 alt="Profile" 
                                 class="rounded-circle" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    <hr>
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile*') && !request()->is('profile/orders*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i> Profil Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('orders*') || request()->is('profile/orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-bag me-2"></i> Pesanan Saya
                                @if($pendingCount > 0)
                                <span class="badge bg-danger float-end">{{ $pendingCount }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            @if(request()->is('profile*') && !request()->is('profile/orders*'))
            <!-- Profile View -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">Profil Saya</h5>
                        <button type="button" class="btn btn-outline-danger" style="color: #ee4d2d; border-color: #ee4d2d;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-1"></i> Edit
                        </button>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Nama</div>
                        <div class="col-md-9">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Email</div>
                        <div class="col-md-9">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 text-muted">Nomor Telepon</div>
                        <div class="col-md-9">{{ Auth::user()->phone ?: '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-muted">Alamat</div>
                        <div class="col-md-9">{{ Auth::user()->address ?: '-' }}</div>
                    </div>
                </div>
            </div>
            @else
            <!-- Orders Section -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pesanan Saya</h5>
                    
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
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-avatar.png') }}" 
                                 alt="Profile" 
                                 class="rounded-circle preview-image" 
                                 style="width: 100px; height: 100px; object-fit: cover;">
                            <label for="photo" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-1 cursor-pointer" style="cursor: pointer;">
                                <i class="fas fa-camera text-muted"></i>
                                <input type="file" id="photo" name="photo" class="d-none" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{ Auth::user()->address }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" style="background-color: #ee4d2d; border-color: #ee4d2d;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.preview-image').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush

<style>
.nav-pills .nav-link {
    color: #666;
    border-radius: 0;
    padding: 0.8rem 1rem;
}

.nav-pills .nav-link.active {
    background-color: #ee4d2d;
    color: white;
}

.nav-pills .nav-link:hover:not(.active) {
    color: #ee4d2d;
    background-color: #fff1ef;
}

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

.modal-header {
    border-bottom: none;
    padding-bottom: 0;
}

.modal-footer {
    border-top: none;
    padding-top: 0;
}
</style>
@endsection
