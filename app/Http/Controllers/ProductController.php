<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('public.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('public.product.detail', compact('product'));
    }
} 