<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTrack</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .navbar {
            padding: 15px 40px;
            background: #ffffff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .home {
            min-height: 90vh;
        }

        .home-left {
            padding: 80px;
        }

        .home-left h1 {
            font-size: 42px;
            font-weight: 600;
        }

        .home-left p {
            margin-top: 15px;
            color: #6c757d;
        }

        #fitur {
            background-color: #0d6efd;
            height: 80vh;
        }

        .btn-main {
            margin-top: 20px;
            background: #2b7cff;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .btn-main:hover {
            background: #1f63d8;
        }

        .home-right {
            position: relative;
            display: flex;
            align-items: center;
        }

        .img-right {
            width: 400px;
            object-fit: cover;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            background: white;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 13px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .bubble-1 {
            top: 80px;
            left: 60px;
        }

        .bubble-2 {
            top: 120px;
            right: 60px;
        }

        .bubble-3 {
            bottom: 80px;
            right: 80px;
        }

        .section {
            padding: 50px 0;
        }

        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 80px;
        }


        .box-fitur {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.3s;
        }

        .box-fitur:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .icon-fitur {
            font-size: 35px;
            color: #2b7cff;
            margin-bottom: 10px;
        }

        .why-box {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            background: #eaf2ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ayoayo {
            background: linear-gradient(135deg, #2b7cef, #4c8dff);
            color: white;
            padding: 60px;
            border-radius: 18px;
            position: relative;
            overflow: hidden;
        }

        .ayoayo::before {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            top: -50px;
            left: -50px;
        }

        .ayoayo::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -80px;
            right: -80px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .nav-link {
            color: #555;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #2b7cff;
        }
    </style>
</head>

<body>
    <nav class="navbar d-flex justify-content-between align-items-center py-2 px-4">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="assets/img/logo1.png" width="40" class="me-2">
            <span style="font-size:22px; font-weight:bold;">
                <span style="color:#0d6efd;">Medi</span>
                <span style="color:#198754;">Track</span>
            </span>
        </a>
        <div class="d-flex align-items-center gap-5">
            <ul class="navbar-nav d-flex flex-row gap-4 mb-0">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#fitur">Feature</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#whyus">Why Us</a>
                </li>
            </ul>
            <a href="login.php" class="btn btn-outline-primary">Login</a>
        </div>

    </nav>

    <section class="home" id="home">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-7 home-left d-flex align-items-center">
                    <div>
                        <h1>Kelola Obatmu Lebih Mudah<br>dan Teratur</h1>
                        <p>
                            Catat, pantau, dan kelola obat harianmu dengan sistem sederhana
                            yang membantu kamu tetap sehat setiap hari.
                        </p>
                        <a href="login.php" class="btn btn-main">Mulai Sekarang</a>
                    </div>
                </div>
                <div class="col-5 home-right">
                    <img src="assets/img/b.jpg" class="img-right">
                    <div class="bubble bubble-1">
                        <strong>150+</strong> Obat Tercatat
                    </div>
                    <div class="bubble bubble-2">
                        <strong>Aktif</strong> Monitoring
                    </div>
                    <div class="bubble bubble-3">
                        <strong>Aman</strong> & Pribadi
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section text-center p-5 d-flex align-items-center" id="fitur">
        <div class="container">
            <h2 class="mb-5 text-light">Fitur Utama</h2>
            <div class="row g-4">
                <div class="col-md-3 d-flex" style="transition-delay:0.1s">
                    <div class="box-fitur w-100">
                        <div class="icon-fitur"><i class="bi bi-capsule-pill"></i></div>
                        <h5>Data Obat</h5>
                        <p>Kelola obat pribadi dengan mudah</p>
                    </div>
                </div>

                <div class="col-md-3 d-flex" style="transition-delay:0.2s">
                    <div class="box-fitur w-100">
                        <div class="icon-fitur"><i class="bi bi-calendar-check"></i></div>
                        <h5>Kadaluarsa</h5>
                        <p>Pantau tanggal expired obat</p>
                    </div>
                </div>

                <div class="col-md-3 d-flex" style="transition-delay:0.3s">
                    <div class="box-fitur w-100">
                        <div class="icon-fitur"><i class="bi bi-journal-text"></i></div>
                        <h5>Catatan</h5>
                        <p>Simpan efek samping & info penting</p>
                    </div>
                </div>

                <div class="col-md-3 d-flex" style="transition-delay:0.4s">
                    <div class="box-fitur w-100">
                        <div class="icon-fitur"><i class="bi bi-bar-chart-line"></i></div>
                        <h5>Monitoring</h5>
                        <p>Lihat data obat secara teratur</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top: 80px;" id="whyus">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="assets/img/a.jpg" width="210">
                </div>
                <div class="col-md-6">
                    <h3><b>Kenapa MediTrack?</b></h3>
                    <div class="why-box mt-4">
                        <div class="icon-circle"><i class="bi bi-check"></i></div>
                        <div>
                            <strong>Mudah digunakan</strong>
                            <p class="mb-0">Interface sederhana dan cepat dipahami</p>
                        </div>
                    </div>
                    <div class="why-box">
                        <div class="icon-circle"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <strong>Aman & pribadi</strong>
                            <p class="mb-0">Data hanya untuk pengguna sendiri</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="ayoayo text-center">
                <h3>Mulai Kelola Obatmu Sekarang</h3>
                <p>Lebih teratur dan aman setiap hari</p>
            </div>
        </div>
    </section>

    <footer>
        © 2026 MediTrack
    </footer>

</body>

</html>