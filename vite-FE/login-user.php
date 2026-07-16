<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login User</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body class="login-page">

<div class="login-container">

<!-- LEFT -->

<div class="login-left user-left">

<div class="login-brand">

<div class="login-logo">

<i class="fa-solid fa-book-open"></i>

</div>

<span>

Sistem Perpustakaan Online

</span>

</div>


<h1>

Temukan Buku Favoritmu

dan nikmati pengalaman

membaca digital yang

lebih modern.

</h1>


<div class="login-line"></div>


<div class="login-image">

<img src="assets/images/user-library.png">

</div>


<div class="login-footer">

© 2026 Kelompok 4 Layanan Web

</div>

</div>



<!-- RIGHT -->

<div class="login-right">

<h2>

SELAMAT DATANG 👋

</h2>

<p class="subtitle">

Silakan login untuk mengakses akun perpustakaan

</p>

<div class="role-switch">

<a
href="login-admin.php">

Admin

</a>

<a
class="active"
href="login-user.php">

User

</a>

</div>

<form action="user/dashboard.php">

<label>

Email

</label>

<div class="form-input">

<i class="fa-regular fa-envelope"></i>

<input
type="email"

placeholder="Masukkan Email">

</div>



<label>

Password

</label>

<div class="form-input">

<i class="fa-solid fa-lock"></i>

<input

id="password"

type="password"

placeholder="Masukkan Password">

<i

id="togglePassword"

class="fa-regular fa-eye toggle-password">

</i>

</div>



<div class="remember-box">

<label>

<input type="checkbox">

Ingat Saya

</label>

<a href="#">

Lupa Password?

</a>

</div>



<button class="btn-login">

Masuk

<i class="fa-solid fa-arrow-right"></i>

</button>

</form>



<div class="support-text">

Belum punya akun?

<a href="#">

Daftar Sekarang

</a>

</div>

</div>

</div>

<script src="assets/js/script.js"></script>

</body>

</html>