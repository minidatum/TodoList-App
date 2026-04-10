# Fitur Edit Inline, Konfigurasi Test MySQL, dan Unit Test CRUD

## Deskripsi
Pembaruan ini mencakup penambahan kemudahan penggunaan di sisi antarmuka, juga perangkuman pembuatan pengujian otomatis (*Automated Testing*) yang kokoh untuk fitur inti Todo.

## Fitur yang Ditambahkan
- **Inline Edit (Vue)**: Pengguna sekarang dapat menekan *double-click* (klik dua kali) pada tugas apapun untuk mengubah teks tugas tersebut.
- **Auto-Save**: Form akan tersimpan secara otomatis (menghasilkan *request inertia*) saat pengguna menekan Enter atau saat kursor fokus berpindah (on blur).
- **Setup MySQL Tests**: Mengganti konfigurasi `phpunit.xml` di mana environment *testing* yang sebelumnya menggunakan memori SQLite diubah dengan membuat koneksi baru database MySQL (`laravel_testing`).
- **Feature Test Todo**: Menambahkan _coverage_ pengujian unit untuk proses Lihat, Buat, Update, Selesai (Toggle), Hapus Todo, hingga batasan larangan keamanan agar _user_ lain tidak dapat mengulih data lain.

## Tugas
- [x] Rancang logika Edit inline pada Vue
- [x] Pastikan input bisa dibatalkan menggunakan tombol `Escape`
- [x] Perbarui file `phpunit.xml` dengan koneksi `mysql` 
- [x] Buat script/tests terpisah di `tests/Feature/TodoTest.php`
- [x] Validasi bahwa skrip tes *pass* (100% OK)
