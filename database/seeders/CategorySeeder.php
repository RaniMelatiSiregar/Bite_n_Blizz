<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Kue',
                'slug' => 'kue',
                'description' => 'Berbagai macam kue lezat'
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Aneka minuman segar'
            ],
            [
                'name' => 'Snack',
                'slug' => 'snack',
                'description' => 'Camilan ringan yang nikmat'
            ],
            [
                'name' => 'Dessert',
                'slug' => 'dessert',
                'description' => 'Hidangan penutup yang manis'
            ],
            [
                'name' => 'Roti',
                'slug' => 'roti',
                'description' => 'Aneka roti segar'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 