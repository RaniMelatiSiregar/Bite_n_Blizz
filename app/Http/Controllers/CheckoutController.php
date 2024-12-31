<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $totalPrice = $carts->sum(function($cart) {
            return $cart->price * $cart->quantity;
        });
        
        return view('public.checkout.index', compact('carts', 'totalPrice'));
    }

    public function process(Request $request)
    {
        try {
            DB::beginTransaction();

            // Ambil data cart
            $carts = Cart::where('user_id', Auth::id())->get();
            if ($carts->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong');
            }

            // Buat order baru
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_amount' => $request->total_amount,
                'address' => $request->address,
                'phone' => $request->phone,
                'notes' => $request->notes,
                'status' => 'pending'
            ]);

            // Simpan item order
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $cart->product_name,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                    'image' => $cart->image
                ]);
            }

            // Hapus cart setelah checkout
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return view('public.checkout.success', compact('order'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan');
        }
    }
} 