# Sistem Manajemen Blog Laravel

Nama: Ahmed Yasser L N I  
NIM: 240605110152

## Deskripsi

Aplikasi ini adalah sistem manajemen blog berbasis Laravel dan MySQL. CMS admin dapat mengelola penulis, kategori artikel, dan artikel. Halaman pengunjung dibuat dengan arsitektur MVC Laravel melalui controller, route, dan Blade template terpisah.

## Fitur

- Kelola data penulis
- Kelola kategori artikel
- Kelola artikel beserta gambar
- Halaman utama pengunjung berbasis Laravel di `/`
- Filter artikel berdasarkan kategori
- Halaman detail artikel di `/artikel/{id}`
- Widget artikel terkait dari kategori yang sama

## Struktur Halaman Pengunjung

- Controller: `app/Http/Controllers/PengunjungController.php`
- Route: `routes/web.php`
- Layout Blade: `resources/views/layouts/pengunjung.blade.php`
- Halaman utama: `resources/views/pengunjung/beranda.blade.php`
- Halaman detail: `resources/views/pengunjung/detail.blade.php`
- CMS admin: `public/cms/index.php`

## Cara Menjalankan

1. Jalankan MySQL melalui Laragon atau XAMPP.
2. Install dependency Laravel:

```bash
composer install
```

3. Salin file environment jika belum ada:

```bash
copy .env.example .env
php artisan key:generate
```

4. Import database dari file `db_blog_setup.sql`.
5. Pastikan konfigurasi database di `.env` sesuai:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=db_blog`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`
6. Jalankan project Laravel:

```bash
php artisan serve
```

7. Buka halaman:
   - Halaman pengunjung: `http://127.0.0.1:8000/`
   - CMS admin: `http://127.0.0.1:8000/cms/index.php`

## Tautan Video Demonstrasi

https://youtu.be/_vGzKCfTops
