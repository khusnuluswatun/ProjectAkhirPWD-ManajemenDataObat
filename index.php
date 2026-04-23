<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($cek);

    if($data){
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];


        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MedVault</title>

    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: url('assets/img/bg.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-card {
            width: 360px;
            padding: 30px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;

            min-height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: center;
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

<div class="card login-card shadow p-4">

    <div class="text-center mb-3">
        <img src="assets/img/logo1.png" width="40" class="mb-2"><br>
        <span style="font-size:22px; font-weight:bold;">
            <span style="color:#0d6efd;">Medi</span>
            <span style="color:#198754;">Track</span>
        </span>
    </div>

    <form method="POST">
        <div id="loginForm"style="margin-top:15px;">
            <h5>Welcome Back</h5>

            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <button name="login" class="btn btn-custom w-100">Sign In</button>

            <div class="small-text text-center">
                Belum punya akun? 
                <a href="#" onclick="showRegister()">Register</a>
            </div>
        </div>
    </form>

    

    <form method="POST">
        <div id="registerForm" style="display:none; margin-top:15px;">
            <h5>Create Account</h5>

            <input type="text" name="nama_lengkap_reg" class="form-control" placeholder="Nama Lengkap" required>
            <input type="text" name="username_reg" class="form-control" placeholder="Username" required>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="tgl_lahir_reg" required>
                <label>Tanggal Lahir</label>
            </div>
            <input type="text" name="email_reg" class="form-control" placeholder="Email" required>
            <input type="text" name="no_hp_reg" class="form-control" placeholder="Nomor Telephone" required>
            <input type="text" name="alamat_reg" class="form-control" placeholder="Alamat" required>
            <input type="password" name="password_reg" class="form-control" placeholder="Password" required>

            <button name="register" class="btn btn-custom w-100">Create Account</button>

            <div class="small-text">
                Sudah punya akun? 
                <a href="#" onclick="showLogin()">Sign In</a>
            </div>
        </div>
    </form>`

</div>

<script>
function showRegister(){
    document.getElementById("loginForm").style.display="none";
    document.getElementById("registerForm").style.display="block";
}

function showLogin(){
    document.getElementById("loginForm").style.display="block";
    document.getElementById("registerForm").style.display="none";
}
</script>

</body>
</html>

<?php

if(isset($_POST['register'])){
    $username = $_POST['username_reg'];
    $password = md5($_POST['password_reg']);
    $nama_lengkap = $_POST['nama_lengkap_reg'];
    $email = $_POST['email_reg'];
    $tgl_lahir = $_POST['tgl_lahir_reg'];
    $no_hp = $_POST['no_hp_reg'];
    $alamat = $_POST['alamat_reg'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password, role, nama_lengkap, email, tgl_lahir, no_hp, alamat) 
                             VALUES ('$username','$password','user','$nama_lengkap', '$email', '$tgl_lahir ', '$no_hp', '$alamat' )");

        echo "<script>alert('Register berhasil, silakan login');</script>";
    }
}
?>