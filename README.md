# Bite n Blizz

## Langkah-langkah Setup Setelah Clone

1. Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database

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
php artisan migrate:fresh
```

5. Jalankan seeder untuk mengisi data awal
```bash
php artisan db:seed --class=ProductSeeder
```

6. Link storage untuk gambar
```bash
php artisan storage:link
```

7. Copy folder `images` dari repository ke folder `public/images`
   - Jika folder `public/images` belum ada, buat terlebih dahulu
   - Pastikan semua gambar produk sudah ada di folder tersebut

8. Jalankan server development
```bash
php artisan serve
npm run dev
```

## Catatan Penting
- Pastikan sudah membuat database kosong sesuai dengan konfigurasi di file `.env`
- Pastikan folder `public/images` berisi semua gambar produk yang diperlukan
- Jika ada masalah dengan tampilan produk, pastikan langkah 5 dan 7 sudah dilakukan dengan benar
