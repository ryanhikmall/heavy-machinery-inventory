# Heavy Machinery Inventory System 🚜

Sistem manajemen stok sparepart alat berat berbasis web untuk memantau barang masuk, keluar, dan peringatan stok menipis.

## Fitur Utama

-   **Dashboard Monitoring:** Statistik total barang dan alert stok kritis.
-   **Role Management:** Admin (Full Akses) & Staff (Read Only).
-   **Stok Otomatis:** Stok berkurang otomatis saat transaksi keluar.
-   **Low Stock Alert:** Indikator merah jika stok di bawah batas minimum.

## Tech Stack

-   Laravel 10
-   Bootstrap 5
-   MySQL

## Cara Instalasi

1. Clone repo ini: `git clone https://github.com/USERNAME/heavy-machinery-inventory.git`
2. Masuk folder: `cd heavy-machinery-inventory`
3. Install library: `composer install`
4. Copy env: `cp .env.example .env`
5. Atur database di file `.env`
6. Generate key: `php artisan key:generate`
7. Migrate & Seed: `php artisan migrate:fresh --seed`
8. Jalankan: `php artisan serve`

## Akun Demo

-   **Admin:** admin@toko.com / password
-   **Staff:** staff@toko.com / password
