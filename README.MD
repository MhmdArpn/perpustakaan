# Panduan Instalasi dan Penggunaan Aplikasi Perpustakaan

### 👥 Daftar Anggota Kelompok
**Kelompok 4 - Layanan Web**
1. **Muhammad Arifin** (2303010219)
2. **Dhika Dwi Hanifa** (2303010219)
3. **Muhammad Ghifar** (2303010226)

---

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan aplikasi Perpustakaan di komputer lokal anda.

---

## 🛠️ Langkah-Langkah Penggunaan

### 1. Kloning Repositori Projek
Buka **Command Prompt (CMD)** di komputer anda, lalu jalankan perintah berikut secara berurutan:
```bash
cd Downloads
git clone [https://github.com/MhmdArpn/perpustakaan](https://github.com/MhmdArpn/perpustakaan)
```
### 2. Setup Projek
Buka **Command Prompt (CMD)** di komputer anda, lalu jalankan perintah berikut secara berurutan:
```bash
cd perpustakaan
cd laravel-BE
cp .env.example .env

composer install
```
tunggu beberapa waktu

jika menggunakan laragon, ubah document root nya ke folder downloads > perpustakaan > laravel-BE > public, jika menggunakan xampp, ubah document rootnya pada httpd.conf untuk diarahkan ke folder yang sama pada laragon

ubah bagian .env di folder laravel-BE :
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```
Buka **Command Prompt (CMD)** kembali dan jalankan perintah berikut
```bash
php artisan key:generate
```
buat database di phpmyadmin (jika menggunakan xampp) atau di heidiSQL (jika menggunakan laragon) dengan nama database perpustakaan
Buka **Command Prompt (CMD)** kembali dan jalankan perintah berikut
```bash
php artisan migrate
```
Aplikasi bisa digunakan 

