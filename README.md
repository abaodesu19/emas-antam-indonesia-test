<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup Project

- Salin environment:
  - `cp .env.example .env`
- Atur koneksi database di file `.env`:
  - `DB_CONNECTION=mysql`
  - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Install dependensi PHP:
  - `composer install`
- Generate app key:
  - `php artisan key:generate`
- Jalankan migrasi:
  - `php artisan migrate`
- Install dependensi frontend:
  - `npm install`
- Mode pengembangan (disarankan saat dev):
  - `npm run dev`
- Mode produksi (membangun asset):
  - `npm run build`

## Seeding Data Produk

- Seeder tersedia: `Database\Seeders\ProductSeeder`
- Jalankan seeder:
  - `php artisan db:seed`
  - Atau khusus: `php artisan db:seed --class=Database\\Seeders\\ProductSeeder`

## Menjalankan Aplikasi

- Jalankan server:
  - `php artisan serve`
  - Akses: `http://localhost:8000` untuk halaman produk (Livewire).
- Alternatif menggunakan server lokal (Herd/nginx) sesuai konfigurasi sistem Anda.

## Troubleshooting

- Jika muncul `Illuminate\Foundation\ViteManifestNotFoundException`:
  - Pastikan sudah menjalankan `npm run build` atau `npm run dev`.
  - Periksa file `public/build/manifest.json` sudah terbentuk.
