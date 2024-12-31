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
                'image' => 'chocoCrispy1.png',
                'category' => 'Kue Kering'
            ],
            [
                'name' => 'Choco Milk',
                'description' => 'Minuman coklat susu yang creamy',
                'price' => 18000,
                'image' => 'chocoMilk.png',
                'category' => 'Minuman'
            ],
            [
                'name' => 'Sus Kering',
                'description' => 'Sus kering yang renyah dengan isian vla',
                'price' => 20000,
                'image' => 'susKering.png',
                'category' => 'Kue Kering'
            ],
            [
                'name' => 'Choco Cookies',
                'description' => 'Cookies coklat yang lembut',
                'price' => 22000,
                'image' => 'chocoCookies.png',
                'category' => 'Kue Kering'
            ],
            [
                'name' => 'Brownies Choco',
                'description' => 'Brownies coklat yang lembut dan moist',
                'price' => 35000,
                'image' => 'browniesChoco.png',
                'category' => 'Kue Basah'
            ],
            [
                'name' => 'Banana Cake',
                'description' => 'Kue pisang yang lembut',
                'price' => 30000,
                'image' => 'bananaCake.png',
                'category' => 'Kue Basah'
            ],
            [
                'name' => 'Pisang Caramel',
                'description' => 'Pisang goreng dengan saus karamel',
                'price' => 25000,
                'image' => 'pisangCaramel.png',
                'category' => 'Kue Basah'
            ],
            [
                'name' => 'Pisang Nuget',
                'description' => 'Nugget pisang yang renyah',
                'price' => 20000,
                'image' => 'pisangNuget.png',
                'category' => 'Kue Basah'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 