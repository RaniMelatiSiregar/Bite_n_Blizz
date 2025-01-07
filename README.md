# Bite n Blizz

## Langkah-langkah Setup Setelah Clone

1. Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database
```bash
cp .env.example .env
```

2. Install dependencies
```bash
composer install
npm install
```

3. Generate key aplikasi
```bash
php artisan key:generate
```

4. Jalankan migrasi database
```bash
php artisan migrate
```

5. Jalankan seeder untuk mengisi data awal
```bash
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

6. Link storage untuk gambar
```bash
php artisan storage:link
```

7. Copy gambar produk ke folder yang benar:
   - Buat folder `storage/app/public/products` jika belum ada
   - Copy semua gambar produk ke folder tersebut
   - Pastikan nama file sesuai dengan yang ada di database:
     - chocoCrispy1.png
     - chocoMilk.png
     - susKering.png
     - chocoCookies.png
     - browniesChoco.png
     - bananaCake.png
     - pisangCaramel.png
     - pisangNuget.png

8. Jalankan server development
```bash
php artisan serve
npm run dev
```

## Catatan Penting
- Pastikan sudah membuat database kosong sesuai dengan konfigurasi di file `.env`
- Pastikan folder `storage/app/public/products` berisi semua gambar produk yang diperlukan
- Setelah clone dan menjalankan `php artisan storage:link`, gambar produk akan tersedia di `public/storage/products`
- Jika ada masalah dengan tampilan produk, pastikan langkah 6 dan 7 sudah dilakukan dengan benar
