@extends('public.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500">
                    <i class="fas fa-home mr-2"></i>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('product') }}" class="text-gray-700 hover:text-orange-500">Produk</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
            </div>
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                <p class="text-3xl font-bold text-orange-500 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-center space-x-4">
                        <label class="font-semibold">Jumlah:</label>
                        <div class="flex items-center border rounded-lg">
                            <button type="button" class="px-4 py-2 text-orange-500 hover:bg-orange-50 rounded-l-lg decrease-quantity">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" name="quantity" value="1" min="1" class="w-20 text-center border-0 focus:ring-0">
                            <button type="button" class="px-4 py-2 text-orange-500 hover:bg-orange-50 rounded-r-lg increase-quantity">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition-colors">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white rounded-lg p-8 max-w-md w-full">
            <div class="text-center">
                <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold mb-4">Produk berhasil ditambahkan ke keranjang!</h3>
                <div class="flex justify-center space-x-4">
                    <button type="button" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" onclick="closeModal()">
                        Lanjut Belanja
                    </button>
                    <a href="{{ route('cart.index') }}" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                        Lihat Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.querySelector('.decrease-quantity');
    const increaseBtn = document.querySelector('.increase-quantity');
    const quantityInput = document.querySelector('input[name="quantity"]');

    decreaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });

    // Handle form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('successModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menambahkan produk ke keranjang');
        });
    });
});

function closeModal() {
    document.getElementById('successModal').classList.add('hidden');
}
</script>
@endpush
@endsection
