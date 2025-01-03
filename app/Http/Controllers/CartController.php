<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        
        $subtotal = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $shipping = $carts->isEmpty() ? 0 : 10000; // Biaya pengiriman flat 10rb jika ada produk
        $total = $subtotal + $shipping;

        return view('public.cart.index', compact('carts', 'subtotal', 'shipping', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek stok produk
        if ($product->qty < $request->quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
        }

        $cart = Cart::where('user_id', Auth::id())
                   ->where('product_id', $product->id)
                   ->first();

        if ($cart) {
            // Cek total quantity setelah ditambah
            $newQuantity = $cart->quantity + $request->quantity;
            if ($product->qty < $newQuantity) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
            }

            $cart->update([
                'quantity' => $newQuantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Cart $cart, Request $request)
    {
        if ($cart->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek stok produk
        if ($cart->product->qty < $request->quantity) {
            return response()->json([
                'error' => 'Stok produk tidak mencukupi!'
            ], 422);
        }

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return response()->json(['success' => true]);
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
