<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Ambil semua produk dengan relasi kategori
    //     $products = Product::with('category');

    //     // Filter berdasarkan kategori jika ada
    //     if ($request->has('category') && $request->category) {
    //         $products = $products->where('category_id', $request->category);
    //     }

    //     // Filter berdasarkan harga jika ada
    //     if ($request->has('min_price') && $request->min_price) {
    //         $products = $products->where('price', '>=', $request->min_price);
    //     }
    //     if ($request->has('max_price') && $request->max_price) {
    //         $products = $products->where('price', '<=', $request->max_price);
    //     }

    //     // Ambil kategori untuk sidebar filter
    //     $categories = Category::all();

    //     // Ambil produk yang telah difilter dan kirim ke view
    //     $products = $products->get();

    //     return view('public.product.index', compact('products', 'categories'));
    // }

    public function index(Request $request)
{
    $query = Product::with('category');

    // Filter kategori jika ada
    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    // Filter harga jika ada
    if ($request->has('min_price') && $request->has('max_price')) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    // Menampilkan hanya produk yang tersedia
    $products = $query->where('is_available', true)->latest()->paginate(10);

    $categories = Category::all();

    return view('public.product.index', compact('products', 'categories'));
}

}