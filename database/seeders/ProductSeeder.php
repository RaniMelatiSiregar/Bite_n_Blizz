<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Choco Crispy',
                'description' => 'Kue kering coklat yang renyah dan lezat',
                'price' => 25000,
                'category_id' => 1,
                'qty' => 50,
                'image' => 'products/chocoCrispy1.png'
            ],
            [
                'name' => 'Choco Milk',
                'description' => 'Minuman coklat susu yang creamy',
                'price' => 18000,
                'category_id' => 2,
                'qty' => 100,
                'image' => 'products/chocoMilk.png'
            ],
            [
                'name' => 'Brownies Choco',
                'description' => 'Brownies coklat yang lembut dan moist',
                'price' => 28000,
                'category_id' => 1,
                'qty' => 30,
                'image' => 'products/browniesChoco.png'
            ],
            [
                'name' => 'Banana Cake',
                'description' => 'Kue pisang yang lembut dan harum',
                'price' => 23000,
                'category_id' => 1,
                'qty' => 40,
                'image' => 'products/bananaCake.png'
            ],
            [
                'name' => 'Pisang Caramel',
                'description' => 'Pisang goreng dengan saus karamel',
                'price' => 20000,
                'category_id' => 3,
                'qty' => 25,
                'image' => 'products/pisangCaramel.png'
            ],
            [
                'name' => 'Pisang Nuget',
                'description' => 'Nugget pisang yang crispy',
                'price' => 15000,
                'category_id' => 3,
                'qty' => 60,
                'image' => 'products/pisangNuget.png'
            ],
            [
                'name' => 'Sus Kering',
                'description' => 'Kue sus kering yang renyah',
                'price' => 22000,
                'category_id' => 1,
                'qty' => 45,
                'image' => 'products/susKering.png'
            ],
            [
                'name' => 'Choco Cookies',
                'description' => 'Cookies coklat yang renyah',
                'price' => 19000,
                'category_id' => 1,
                'qty' => 70,
                'image' => 'products/chocoCookies.png'
            ],
            // Tambahkan produk lainnya di sini
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 