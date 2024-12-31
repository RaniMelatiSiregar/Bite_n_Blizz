<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('public.cart.index', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            
            // Cek apakah produk sudah ada di cart
            $existingCart = Cart::where('user_id', Auth::id())
                              ->where('product_id', $product->id)
                              ->first();

            if ($existingCart) {
                // Update quantity jika produk sudah ada
                $existingCart->quantity += $request->quantity;
                $existingCart->save();
                $cart = $existingCart;
            } else {
                // Buat item baru jika produk belum ada
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity
                ]);
            }

            // Update cart count in session
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            session(['cart_count' => $cartCount]);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'data' => $cart,
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk ke keranjang'
            ], 500);
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $cart = Cart::findOrFail($id);
            $cart->quantity = max(1, $request->quantity);
            $cart->save();

            // Update cart count in session
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            session(['cart_count' => $cartCount]);

            return response()->json([
                'success' => true,
                'message' => 'Quantity berhasil diupdate',
                'data' => $cart,
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate quantity'
            ], 500);
        }
    }

    public function remove($id)
    {
        try {
            $cart = Cart::findOrFail($id);
            $cart->delete();

            // Update cart count in session
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            session(['cart_count' => $cartCount]);

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang',
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item dari keranjang'
            ], 500);
        }
    }
}
