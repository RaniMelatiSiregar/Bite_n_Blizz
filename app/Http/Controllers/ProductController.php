<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $produk = Produk::all();
        $categories = Category::all();
        return view('public.product.index', compact('products', 'produk', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('public.product.detail', compact('product'));
    }
} 