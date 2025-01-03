<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        // Cek apakah ada produk di keranjang
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong! Silakan tambahkan produk terlebih dahulu.');
        }

        // Hitung total
        $subtotal = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        $shipping = 10000; // Biaya pengiriman flat 10rb
        $total = $subtotal + $shipping;

        return view('public.checkout.index', compact('carts', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        Log::info('Memulai proses checkout', ['request' => $request->all()]);

        try {
            DB::beginTransaction();

            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'payment_method' => 'required|in:transfer,cod'
            ]);

            // Ambil data keranjang
            $carts = Cart::where('user_id', Auth::id())->with('product')->get();
            
            if ($carts->isEmpty()) {
                throw new \Exception('Keranjang belanja kosong!');
            }

            // Hitung total
            $subtotal = $carts->sum(function($cart) {
                return $cart->product->price * $cart->quantity;
            });
            $shipping = 10000;
            $total = $subtotal + $shipping;

            // Validasi stok
            foreach ($carts as $cart) {
                if ($cart->product->qty < $cart->quantity) {
                    throw new \Exception("Stok produk {$cart->product->name} tidak mencukupi!");
                }
            }

            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
                'shipping_name' => $validated['name'],
                'shipping_phone' => $validated['phone'],
                'shipping_address' => $validated['address'],
                'total_amount' => $total,
                'shipping_fee' => $shipping
            ]);

            // Simpan item pesanan
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price
                ]);

                // Kurangi stok
                $cart->product->decrement('qty', $cart->quantity);
            }

            // Hapus keranjang
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran sesuai metode yang dipilih.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            return back()->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Mohon periksa kembali form isian Anda.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat checkout: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage());
        }
    }
} 