# Pembuatan Aplikasi Todo List dengan Vue dan Laravel Breeze

## Deskripsi
Buat fungsionalitas aplikasi Todo list di dalam project Laravel 10 yang sudah ada. Aplikasi ini harus menggunakan Vue.js di bagian frontend dan memiliki sistem autentikasi pengguna secara penuh.

## Fitur yang Dibutuhkan
- **Sistem Autentikasi**: Registrasi, Login, dan manajemen sesi menggunakan Laravel Breeze (Vue & Inertia stack).
- **CRUD Todo**:
  - `Create`: Pengguna dapat menambahkan tugas baru.
  - `Read`: Pengguna dapat melihat daftar tugas miliknya sendiri.
  - `Update`: Pengguna dapat menandai tugas sebagai selesai atau belum selesai.
  - `Delete`: Pengguna dapat menghapus tugas.
- **Isolasi Pengguna**: Setiap pengguna hanya dapat mengakses tugas mereka masing-masing.

## Tugas
- [x] Ubah koneksi database `.env` menjadi `sqlite`.
- [x] Instal dependensi: `laravel/breeze`.
- [x] Jalankan `php artisan breeze:install vue` dan kompilasi *assets* dengan `npm run build`.
- [x] Buat file *database* SQLite.
- [x] Buat *migration*, *model*, dan *controller* untuk Todo.
- [x] Tambahkan relasi *One-to-Many* pada model `User`.
- [x] Tentukan *routing* yang dilindungi middleware `auth`.
- [x] Bangun komponen antarmuka (*UI*) menggunakan Vue.js dan Inertia.js.
- [ ] Lakukan *migration* ke database.

## Catatan Tambahan
Gunakan SQLite untuk memudahkan pengembangan di *environment* lokal tanpa memerlukan konfigurasi eksternal MySQL.
