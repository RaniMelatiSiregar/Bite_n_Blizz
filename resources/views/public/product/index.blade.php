@extends('public.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Grid -->
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/chocoCrispy1.png') }}" 
                     class="card-img-top" 
                     alt="Choco Crispy"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Choco Crispy</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp25.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/chocoMilk.png') }}" 
                     class="card-img-top" 
                     alt="Choco Milk"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Choco Milk</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp18.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/susKering.png') }}" 
                     class="card-img-top" 
                     alt="Sus Kering"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Sus Kering</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp20.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/chocoCookies.png') }}" 
                     class="card-img-top" 
                     alt="Choco Cookies"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Choco Cookies</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp22.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/browniesChoco.png') }}" 
                     class="card-img-top" 
                     alt="Brownies Choco"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Brownies Choco</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp28.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/bananaCake.png') }}" 
                     class="card-img-top" 
                     alt="Banana Cake"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Banana Cake</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp23.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/pisangCaramel.png') }}" 
                     class="card-img-top" 
                     alt="Pisang Caramel"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Pisang Caramel</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp21.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/pisangNuget.png') }}" 
                     class="card-img-top" 
                     alt="Pisang Nuget"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Pisang Nuget</h5>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="card-text text-danger fw-bold">Rp19.000</p>
                    <div class="mt-auto">
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses Tambah ke Keranjang -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <i class="fas fa-check-circle mb-4 modal-success-icon"></i>
                <h3 class="modal-success-title mb-4">Berhasil Ditambahkan ke Keranjang!</h3>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-primary px-4 py-2" data-bs-dismiss="modal" style="min-width: 150px;">
                        <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-primary px-4 py-2" style="min-width: 150px;">
                        <i class="fas fa-shopping-cart me-2"></i>Lihat Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.add-to-cart-form');
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    
    forms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });

                const response = await fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    throw new Error('Gagal menambahkan ke keranjang');
                }

                const result = await response.json();
                
                // Update jumlah item di keranjang (jika ada)
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    const currentCount = parseInt(cartCount.textContent || '0');
                    cartCount.textContent = currentCount + 1;
                }

                // Tampilkan modal sukses
                successModal.show();

            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menambahkan produk ke keranjang. Silakan coba lagi.');
            }
        });
    });
});
</script>
@endsection 