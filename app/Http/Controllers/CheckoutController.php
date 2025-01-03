<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping_fee = 10000; // Biaya pengiriman tetap Rp 10.000
        $discount_amount = 0;

        // Jika ada voucher aktif, hitung diskon
        if (session()->has('active_voucher')) {
            $voucher = session('active_voucher');
            $discount_amount = ($total * $voucher->discount) / 100;
        }

        $final_total = $total - $discount_amount + $shipping_fee;

        return view('public.checkout.index', compact('cartItems', 'total', 'shipping_fee', 'discount_amount', 'final_total'));
    }

    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string'
        ]);

        // Ubah kode voucher menjadi uppercase untuk konsistensi
        $voucher_code = strtoupper($request->voucher_code);

        $voucher = Voucher::where('code', $voucher_code)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->first();

        if (!$voucher) {
            return back()->with('voucher_error', 'Kode voucher tidak valid atau sudah kadaluarsa');
        }

        session(['active_voucher' => $voucher]);
        return back()->with('voucher_success', 'Voucher berhasil digunakan');
    }

    public function removeVoucher()
    {
        session()->forget('active_voucher');
        return back()->with('success', 'Voucher berhasil dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|in:transfer,cod'
        ]);

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong');
        }

        try {
            DB::beginTransaction();

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $shipping_fee = 10000;
            $discount_amount = 0;
            $voucher_id = null;

            // Terapkan diskon jika ada voucher aktif
            if (session()->has('active_voucher')) {
                $voucher = session('active_voucher');
                $discount_amount = ($total * $voucher->discount) / 100;
                $voucher_id = $voucher->id;
            }

            $final_total = $total - $discount_amount + $shipping_fee;

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'status' => 'pending',
                'total_amount' => $final_total,
                'shipping_fee' => $shipping_fee,
                'shipping_address' => $request->address,
                'shipping_name' => $request->name,
                'shipping_phone' => $request->phone,
                'payment_status' => 'unpaid',
                'payment_method' => $request->payment_method,
                'voucher_id' => $voucher_id,
                'discount_amount' => $discount_amount
            ]);

            foreach ($cartItems as $item) {
                $order->orderItems()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // Hapus keranjang
            Cart::where('user_id', Auth::id())->delete();

            // Hapus voucher dari session
            session()->forget('active_voucher');

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating order: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.');
        }
    }
} 