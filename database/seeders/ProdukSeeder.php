<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Buat kategori default jika belum ada
        $category = Category::firstOrCreate([
            'name' => 'Kue Kering',
            'slug' => 'kue-kering'
        ]);

        $products = [
            [
                'category_id' => $category->id,
                'kode_produk' => 'CC001',
                'nama_produk' => 'Choco Crispy',
                'slug' => 'choco-crispy',
                'gambar_produk' => 'chocoCrispy1.png',
                'deskripsi_produk' => 'Kue coklat crispy yang lezat',
                'qty' => 100,
                'satuan' => 'pcs',
                'harga' => 25000
            ],
            [
                'category_id' => $category->id,
                'kode_produk' => 'CM001',
                'nama_produk' => 'Choco Milk',
                'slug' => 'choco-milk',
                'gambar_produk' => 'chocoMilk.png',
                'deskripsi_produk' => 'Kue coklat dengan susu yang lembut',
                'qty' => 100,
                'satuan' => 'pcs',
                'harga' => 18000
            ],
            [
                'category_id' => $category->id,
                'kode_produk' => 'SK001',
                'nama_produk' => 'Sus Kering',
                'slug' => 'sus-kering',
                'gambar_produk' => 'susKering.png',
                'deskripsi_produk' => 'Sus kering yang renyah',
                'qty' => 100,
                'satuan' => 'pcs',
                'harga' => 20000
            ]
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
} 