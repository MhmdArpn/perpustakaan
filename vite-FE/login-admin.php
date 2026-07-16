<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login Admin</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body class="login-page">

<div class="login-container">

<div class="login-left">

<div class="login-brand">

<div class="login-logo">

<i class="fa-solid fa-book-open"></i>

</div>

<span>

Sistem Perpustakaan Online

</span>

</div>


<h1>

Sistem Perpustakaan Digital

Modern untuk pengalaman

membaca yang lebih mudah.

</h1>

<div class="login-line"></div>

<div class="login-image">

<img src="assets/images/library.png">

</div>

<div class="login-footer">

© 2026 Kelompok 4 Layanan Web

</div>

</div>



<div class="login-right">

<h2>

SELAMAT DATANG 👋

</h2>

<p>

Silakan login untuk melanjutkan

</p>

<div class="role-switch">

<a class="active"
href="login-admin.php">

Admin

</a>

<a
href="login-user.php">

User

</a>

</div>

<form action="admin/dashboard.php">

<label>

Email

</label>

<div class="form-input">

<i class="fa-regular fa-envelope"></i>

<input
type="email"

placeholder="Masukkan email">

</div>



<label>

Password

</label>

<div class="form-input password-box">

<i class="fa-solid fa-lock"></i>

<input
id="password"
type="password"
placeholder="Masukkan password">

<i
class="fa-regular fa-eye toggle-password"
id="togglePassword">
</i>

</div>

<div class="remember-box">

<label>

<input type="checkbox">

Ingat saya

</label>

<a href="#">

Lupa password?

</a>

</div>



<button class="btn-login">

Masuk

<i class="fa-solid fa-arrow-right"></i>

</button>

</form>



<div class="support-text">

Butuh bantuan akses?

<a href="#">

Hubungi IT Support

</a>

</div>

</div>

</div>

<script src="assets/js/script.js"></script>

</body>

</html>