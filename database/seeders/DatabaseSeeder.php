<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil AdminSeeder
        $this->call(AdminSeeder::class);

        // Buat Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'phone' => '08123456789',
            'address' => 'Jl. Admin No. 1',
        ]);

        // Buat Kategori
        $categories = [
            ['name' => 'Makanan'],
            ['name' => 'Minuman'],
            ['name' => 'Snack'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Buat Produk
        $products = [
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng spesial dengan telur dan ayam',
                'price' => 15000,
                'qty' => 100,
                'image' => 'products/nasi-goreng.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Es Teh',
                'description' => 'Es teh manis segar',
                'price' => 5000,
                'qty' => 100,
                'image' => 'products/es-teh.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Kentang Goreng',
                'description' => 'Kentang goreng crispy',
                'price' => 10000,
                'qty' => 100,
                'image' => 'products/kentang-goreng.jpg'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
