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
- [ ] Ubah koneksi database `.env` menjadi `sqlite`.
- [ ] Instal dependensi: `laravel/breeze`.
- [ ] Jalankan `php artisan breeze:install vue` dan kompilasi *assets* dengan `npm run build`.
- [ ] Buat file *database* SQLite.
- [ ] Buat *migration*, *model*, dan *controller* untuk Todo.
- [ ] Tambahkan relasi *One-to-Many* pada model `User`.
- [ ] Tentukan *routing* yang dilindungi middleware `auth`.
- [ ] Bangun komponen antarmuka (*UI*) menggunakan Vue.js dan Inertia.js.
- [ ] Lakukan *migration* ke database.

## Catatan Tambahan
Gunakan SQLite untuk memudahkan pengembangan di *environment* lokal tanpa memerlukan konfigurasi eksternal MySQL.
