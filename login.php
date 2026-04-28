<?php
session_start();
include "koneksi.php";
if (isset($_SESSION['id']) && $_SESSION['id']) {
    header("location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($cek);

    if ($data) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];

        header("location: dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Cek kembali username dan password Anda";
        header("location: login.php");
        exit;
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username_reg'];
    $password = md5($_POST['password_reg']);
    $nama_lengkap = $_POST['nama_lengkap_reg'];
    $email = $_POST['email_reg'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['error'] = "Username sudah digunakan!";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password, role, nama_lengkap, email)
                             VALUES ('$username','$password','user','$nama_lengkap','$email')");
        $_SESSION['success'] = "Register berhasil, silakan login!";
    }

    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>MediTrack</title>

    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/img/logo1.png" type="image/x-icon">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('assets/img/bg.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-card {
            width: 360px;
            padding: 40px 30px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-card h5 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 12px;
        }

        .btn-custom {
            background: linear-gradient(to right, #4facfe, #0066ff);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 8px;
        }

        .small-text {
            font-size: 13px;
            color: #888;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($_SESSION['error'])): ?>
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '<?= $_SESSION['error']; ?>',
                icon: 'warning'
            });
        </script>
    <?php unset($_SESSION['error']);
    endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '<?= $_SESSION['success']; ?>',
                icon: 'success'
            });
        </script>
    <?php unset($_SESSION['success']);
    endif; ?>


    <div class="login-card">
        <div class="mb-3">
            <img src="assets/img/logo1.png" width="40"><br>
            <span style="font-size:22px; font-weight:bold;">
                <span style="color:#0d6efd;">Medi</span>
                <span style="color:#198754;">Track</span>
            </span>
        </div>
        <form method="POST">
            <div id="loginForm">
                <h5>Welcome Back</h5>
                <input type="text" name="username" class="form-control" placeholder="Username" required pattern=".*\S.*">
                <input type="password" name="password" class="form-control" placeholder="Password" required pattern=".*\S.*">
                <button name="login" class="btn btn-custom w-100">Sign In</button>
                <div class="small-text">
                    Belum punya akun?
                    <a href="#" onclick="showRegister()">Register</a>
                </div>
            </div>
        </form>

        <form method="POST">
            <div id="registerForm" style="display:none;">
                <h5>Create Account</h5>
                <input type="text" name="nama_lengkap_reg" class="form-control" placeholder="Nama Lengkap" required pattern=".*\S.*" minlength="5">
                <input type="text" name="username_reg" class="form-control" placeholder="Username" required pattern=".*\S.*" minlength="5">
                <input type="email" name="email_reg" class="form-control" placeholder="Email" required pattern=".*\S.*">
                <input type="password" name="password_reg" class="form-control" placeholder="Password" required pattern=".*\S.*" minlength="3">
                <button name="register" class="btn btn-custom w-100">Create Account</button>
                <div class="small-text">
                    Sudah punya akun?
                    <a href="#" onclick="showLogin()">Sign In</a>
                </div>
            </div>
        </form>

    </div>

    <script>
        function showRegister() {
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("registerForm").style.display = "block";
        }

        function showLogin() {
            document.getElementById("loginForm").style.display = "block";
            document.getElementById("registerForm").style.display = "none";
        }
    </script>

</body>

</html>