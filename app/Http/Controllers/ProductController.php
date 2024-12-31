<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Choco Crispy',
                'price' => 25000,
                'image' => 'chocoCrispy1.png'
            ],
            [
                'id' => 2,
                'name' => 'Choco Milk',
                'price' => 18000,
                'image' => 'chocoMilk.png'
            ],
            [
                'id' => 3,
                'name' => 'Sus Kering',
                'price' => 20000,
                'image' => 'susKering.png'
            ],
            [
                'id' => 4,
                'name' => 'Choco Cookies',
                'price' => 22000,
                'image' => 'chocoCookies.png'
            ],
            [
                'id' => 5,
                'name' => 'Brownies Choco',
                'price' => 28000,
                'image' => 'browniesChoco.png'
            ],
            [
                'id' => 6,
                'name' => 'Banana Cake',
                'price' => 23000,
                'image' => 'bananaCake.png'
            ],
            [
                'id' => 7,
                'name' => 'Pisang Caramel',
                'price' => 21000,
                'image' => 'pisangCaramel.png'
            ],
            [
                'id' => 8,
                'name' => 'Pisang Nuget',
                'price' => 19000,
                'image' => 'pisangNuget.png'
            ]
        ];

        return view('public.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('public.product.detail', compact('product'));
    }
} 