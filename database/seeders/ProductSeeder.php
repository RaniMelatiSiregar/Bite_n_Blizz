<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Choco Crispy',
                'price' => 25000,
                'image' => 'chocoCrispy1.png',
                'description' => 'Kue coklat crispy yang lezat'
            ],
            [
                'name' => 'Choco Milk',
                'price' => 18000,
                'image' => 'chocoMilk.png',
                'description' => 'Kue coklat dengan susu yang lembut'
            ],
            [
                'name' => 'Sus Kering',
                'price' => 20000,
                'image' => 'susKering.png',
                'description' => 'Sus kering yang renyah'
            ],
            [
                'name' => 'Choco Cookies',
                'price' => 22000,
                'image' => 'chocoCookies.png',
                'description' => 'Cookies coklat yang renyah'
            ],
            [
                'name' => 'Brownies Choco',
                'price' => 28000,
                'image' => 'browniesChoco.png',
                'description' => 'Brownies coklat yang lembut'
            ],
            [
                'name' => 'Banana Cake',
                'price' => 23000,
                'image' => 'bananaCake.png',
                'description' => 'Kue pisang yang lembut'
            ],
            [
                'name' => 'Pisang Caramel',
                'price' => 21000,
                'image' => 'pisangCaramel.png',
                'description' => 'Pisang dengan caramel yang manis'
            ],
            [
                'name' => 'Pisang Nuget',
                'price' => 19000,
                'image' => 'pisangNuget.png',
                'description' => 'Nugget pisang yang renyah'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 