<div align="center">
   <h1>
      Coding Test Laravel PT. Borwita Citra Prima (AGUS PRASETYO)
   </h1>
</div>

## How to use
1. Clone repository ini
2. Membuat database `borwita_technical_test`
3. setelah itu masuk ke folder, dan ketik di terminal `composer install` agar file bisa digunakan
4. Rubah file `.env.example` menjadi `.env`, kemudian ketik di terminal `php artisan key:generate` untuk menginisialisasi KEY
5. isi data berikut di file `.env` sesuai dengan db yang dibuat
	```env
	DB_CONNECTION=pgsql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=borwita_technical_test
	DB_USERNAME=username_phpmyadmin (biasanya postgres)
	DB_PASSWORD=
	```
6. setelah sukses, tambahkan tabel dengan migrate, caranya adalah dengan ketik di terminal `php artisan migrate`
7. Untuk menambahkan data dummy, maka tambahkan seeder, dengan cara ketik di terminal `php artisan db:seed`
8. Aplikasi dapat digunakan 😊

## Authentifikasi

### Admin
Email : admin@quizku.test

## Progress
- v1.0.1 (Form Admin)
  - Membuat basic & master layout
  - Membuat basic migration, seeder, modal, controller pada masing-masing modul
  - Menyelesaikan fitur dashboard awal, login admin, direction setelah login admin, membuat navbar untuk kebutuhan input data (master quiz & leaderboard)
  - Membuat middleware untuk logic authentifikasi admin
- v1.0.2 (Form Master Quiz)
  - menyelesaikan semua fitur untuk master quiz
  - table menggunakan datatables 
  - semua penambahan, penghapusan dll menggunakan ajax
- v1.0.3 (Form Leaderboard)
  - Finish leaderboard
- v1.0.4 (Form Quiz)
  - menyelesaikan question beserta rule nya
  - menambahkan logicx untuk menampilkan data
  - menampilkan data jam, dll

## Screenshot
