<p align="center"><a href="https://emasantam.id" target="_blank"><img src="https://emasantam.id/wp-content/uploads/2021/09/Logo-EAI-Baru-Warna.svg" width="400" alt="Emas Antam Indonesia"></a></p>

## LINK DEMO

- Akses: `https://emasantam.id/eai-test` untuk demo aplikasi.

## Setup Project

- Salin environment:
  - `cp .env.example .env`
- Atur koneksi database di file `.env`:
  - `DB_CONNECTION=mysql`
  - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Install dependensi PHP:
  - `composer install`
- Install dependensi frontend:
  - `npm install`
- Generate app key:
  - `php artisan key:generate`
- Jalankan migrasi + produk seeder:
  - `php artisan migrate:fresh --seed`
- Mode pengembangan (dev):
  - `composer run dev`
- Mode Production:
  - `npm run build`

## Running Aplikasi

- Jalankan server:
  - `composer run dev`
  - Akses: `http://localhost:8000` untuk halaman produk (Livewire).
- Alternatif menggunakan server lokal (Herd/nginx) sesuai konfigurasi sistem Anda.

## Troubleshooting

- Jika muncul `Illuminate\Foundation\ViteManifestNotFoundException`:
  - Pastikan sudah menjalankan `npm run build` atau `npm run dev`.
  - Periksa file `public/build/manifest.json` sudah terbentuk.
