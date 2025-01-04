<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        
        $subtotal = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $shipping = $carts->isEmpty() ? 0 : 10000;
        $total = $subtotal + $shipping;

        return view('public.cart.index', compact('carts', 'subtotal', 'shipping', 'total'));
    }

    // Menambahkan produk ke keranjang
    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($product->qty < $request->quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
        }

        $cart = Cart::where('user_id', Auth::id())
                   ->where('product_id', $product->id)
                   ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $request->quantity;
            if ($product->qty < $newQuantity) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
            }

            $cart->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        // Redirect kembali ke halaman keranjang setelah produk ditambahkan
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Memperbarui jumlah produk di keranjang
    public function update(Cart $cart, Request $request)
    {
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Unauthorized');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = $cart->product;
        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan!');
        }

        if ($product->qty < $request->quantity) {
            return redirect()->route('cart.index')->with('error', 'Stok produk tidak mencukupi!');
        }

        $cart->update(['quantity' => $request->quantity]);

        // Redirect kembali ke halaman keranjang setelah jumlah diperbarui
        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui!');
    }

    // Menghapus produk dari keranjang
    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Unauthorized');
        }

        $cart->delete();

        // Redirect kembali ke halaman keranjang setelah produk dihapus
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
