<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $totalPrice = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('public.checkout.index', compact('carts', 'totalPrice'));
    }

    public function process(Request $request)
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $totalPrice = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        // Cek dan terapkan voucher jika ada
        if ($request->filled('applied_voucher_id')) {
            $voucher = Voucher::find($request->applied_voucher_id);
            if ($voucher && $voucher->is_active && $voucher->expiration_date >= now()) {
                $discount = ($totalPrice * $voucher->discount) / 100;
                $totalPrice -= $discount;
            }
        }

        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Buat order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . Str::random(10),
            'total_amount' => $totalPrice,
            'address' => $request->address,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        // Buat order items
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $cart->product->name,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity,
                'image' => $cart->product->image
            ]);
        }

        // Kosongkan keranjang
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.index')
                        ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
} 