@extends('public.layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Checkout</h4>

    @if(isset($carts) && count($carts) > 0)
    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Form Alamat -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Alamat Pengiriman</h5>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Detail Pesanan -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Detail Pesanan</h5>
                        @foreach($carts as $cart)
                        <div class="d-flex mb-3">
                            <img src="{{ asset('storage/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="me-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1">{{ $cart->product->name }}</h6>
                                <p class="mb-1">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                                <p class="mb-0 text-danger">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Harga</span>
                            <span class="text-danger">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>

                        <!-- Voucher Form -->
                        <div class="mb-3">
                            <label class="form-label">Voucher</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="voucher_code" name="voucher_code" placeholder="Masukkan kode voucher">
                                <button class="btn btn-outline-secondary" type="button" id="checkVoucher">
                                    Gunakan
                                </button>
                            </div>
                            <div id="voucherMessage" class="form-text"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-3 d-none" id="discountRow">
                            <span>Diskon Voucher</span>
                            <span class="text-success" id="discountAmount">-Rp 0</span>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total Tagihan</span>
                            <span class="fw-bold text-danger" id="finalTotal">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                        <input type="hidden" name="total_amount" value="{{ $totalPrice }}" id="totalAmountInput">
                        <input type="hidden" name="applied_voucher_id" id="appliedVoucherId">
                        <button type="submit" class="btn btn-danger w-100" style="background-color: #ee4d2d; border-color: #ee4d2d;">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="text-center py-5">
        <h5>Tidak ada item untuk checkout</h5>
        <a href="{{ route('product') }}" class="btn btn-primary mt-3">Kembali Belanja</a>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkVoucherBtn = document.getElementById('checkVoucher');
    const voucherInput = document.getElementById('voucher_code');
    const voucherMessage = document.getElementById('voucherMessage');
    const discountRow = document.getElementById('discountRow');
    const discountAmount = document.getElementById('discountAmount');
    const finalTotal = document.getElementById('finalTotal');
    const totalAmountInput = document.getElementById('totalAmountInput');
    const appliedVoucherId = document.getElementById('appliedVoucherId');
    const originalTotal = {{ $totalPrice }};

    checkVoucherBtn.addEventListener('click', async function() {
        const code = voucherInput.value.trim();
        if (!code) {
            voucherMessage.textContent = 'Masukkan kode voucher';
            voucherMessage.className = 'form-text text-danger';
            return;
        }

        try {
            const response = await fetch(`/check-voucher/${code}`);
            const data = await response.json();

            if (data.valid) {
                // Hitung diskon
                const discount = (originalTotal * data.voucher.discount) / 100;
                const finalAmount = originalTotal - discount;

                // Update UI
                discountRow.classList.remove('d-none');
                discountAmount.textContent = `-Rp ${numberFormat(discount)}`;
                finalTotal.textContent = `Rp ${numberFormat(finalAmount)}`;
                totalAmountInput.value = finalAmount;
                appliedVoucherId.value = data.voucher.id;

                // Tampilkan pesan sukses
                voucherMessage.textContent = 'Voucher berhasil digunakan!';
                voucherMessage.className = 'form-text text-success';
            } else {
                // Reset UI
                discountRow.classList.add('d-none');
                finalTotal.textContent = `Rp ${numberFormat(originalTotal)}`;
                totalAmountInput.value = originalTotal;
                appliedVoucherId.value = '';

                // Tampilkan pesan error
                voucherMessage.textContent = data.message || 'Voucher tidak valid';
                voucherMessage.className = 'form-text text-danger';
            }
        } catch (error) {
            console.error('Error:', error);
            voucherMessage.textContent = 'Terjadi kesalahan, silakan coba lagi';
            voucherMessage.className = 'form-text text-danger';
        }
    });

    function numberFormat(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
});
</script>
@endpush
@endsection 