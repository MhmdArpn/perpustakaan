# Panduan Instalasi dan Penggunaan Aplikasi Perpustakaan

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan aplikasi Perpustakaan di komputer lokal kamu.

---

## 🛠️ Langkah-Langkah Penggunaan

### 1. Kloning Repositori Projek
Buka **Command Prompt (CMD)** di komputer kamu, lalu jalankan perintah berikut secara berurutan:
```bash
cd Downloads
git clone [https://github.com/MhmdArpn/perpustakaan](https://github.com/MhmdArpn/perpustakaan)
cd perpustakaan
cd laravel-BE
cp .env.example .env

composer install

tunggu beberapa waktu

jika menggunakan laragon, ubah document root nya ke folder downloads > perpustakaan > laravel-BE > public, jika menggunakan xampp, ubah document rootnya pada httpd.conf untuk diarahkan ke folder yang sama pada laragon

ubah bagian .env di folder laravel-BE :

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=perpustakaan

DB_USERNAME=root

DB_PASSWORD=

buka kembali cmd dan ketik php artisan key:generate

buat database di phpmyadmin (jika menggunakan xampp) atau di heidiSQL (jika menggunakan laragon) dengan nama database perpustakaan

buka cmd kembali dan ketik php artisan migrate

Aplikasi bisa digunakan 

