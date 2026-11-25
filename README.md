# SISTEM INFORMASI ADMIN KEDAI MIE JEBEW

Aplikasi pengelolaan data Kedai Mie Jebew berbasis web yang dibangun menggunakan framework Laravel 10.

## Deskripsi Project

Project ini merupakan sistem informasi berbasis web untuk membantu pengelolaan administrasi Kedai Mie Jebew.

Aplikasi difokuskan pada bagian backend (administrator) dengan dua hak akses, yaitu Admin dan Super Admin.

## Teknologi yang Digunakan

- Laravel 10
- PHP
- MySQL
- Bootstrap
- JavaScript
- Kaiadmin Lite
- HTML dan CSS

## Fitur Aplikasi

### 1. Login
- Login Admin dan Super Admin.
- Pembatasan akses berdasarkan role pengguna.

### 2. Dashboard
- Menampilkan ringkasan data aplikasi.
- Menampilkan informasi jumlah user, produk, kategori, dan pesanan.

### 3. Data User
- Mengelola data pengguna administrator.
- Fitur hanya dapat diakses Super Admin.

### 4. Data Kategori
- Menambah, melihat, mengubah, dan menghapus kategori produk.

### 5. Data Produk
- Menambah, melihat, mengubah, dan menghapus produk.
- Mengelola foto produk.

### 6. Data Pesanan
- Menambahkan pesanan melalui halaman administrator.
- Melihat detail pesanan.
- Mengelola status pesanan.
- Mengembalikan stok produk ketika pesanan dibatalkan.
- Mencetak struk pesanan.

### 7. Laporan
- Laporan data user.
- Laporan data produk.
- Laporan data pesanan.
- Pencetakan laporan berdasarkan rentang tanggal.

### 8. Pengaturan
- Pengaturan profil pengguna.
- Pengaturan tema dan warna tampilan.
- Pengaturan jenis, ukuran, dan warna font.

## Persyaratan Sistem

- PHP sesuai kebutuhan Laravel 10 (minimal PHP 8.1).
- Composer.
- MySQL.
- Apache atau web server lainnya.
- Browser.

## Cara Instalasi dan Menjalankan Aplikasi

1. Salin folder project ke direktori server lokal.
2. Buka terminal pada folder project.
3. Instal dependensi Composer jika diperlukan:

   ```bash
   composer install
   ```

4. Salin file `.env.example` menjadi `.env`.

5. Atur konfigurasi database pada file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_miejebew1
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Buat database dengan nama `db_miejebew1` melalui phpMyAdmin.

7. Impor file database SQL yang tersedia di folder `database/backup`.

8. Buat application key:

   ```bash
   php artisan key:generate
   ```

9. Buat symbolic link untuk penyimpanan file:

   ```bash
   php artisan storage:link
   ```

10. Jalankan aplikasi:

    ```bash
    php artisan serve
    ```

11. Buka aplikasi melalui browser:

    ```text
    http://127.0.0.1:8000
    ```

## Catatan

- Aplikasi difokuskan pada pengelolaan backend administrator.
- Hak akses Admin dan Super Admin dibedakan berdasarkan role.
- Database awal tersedia dalam folder `database/backup`.
- File `.env` perlu dibuat berdasarkan `.env.example` sebelum aplikasi dijalankan.

## Pengembang

Project Tugas Akhir Semester Mata Kuliah Web Programming II.