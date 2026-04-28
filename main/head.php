<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Khusnul">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/img/logo1.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <svg style="display: none;">
        <symbol id="speedometer2" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z" />
            <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z" />
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol id="box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 15a1 1 0 0 0 1-1v-3h-1v3H2V2h8v3h1V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8z" />
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
        </symbol>
    </svg>

    <header class="navbar sticky-top navbar-light bg-white shadow-sm px-3">
        <a class="navbar-brand d-flex align-items-center bg-white gap-2" href="index.php">
            <img src="assets/img/logo1.png" width="32">
            <span class="fw-bold">
                <span class="text-primary">Medi</span><span class="text-success">Track</span>
            </span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <img src="assets/img/profile.png" class="img-profile"> <?= strtoupper($_SESSION['nama_lengkap']); ?>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="pt-3">
                    <ul class="nav flex-column m-2">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= basename($_SESSION['role']) == 'admin' ? 'profileAdmin.php' : 'profile.php' ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'profile.php' || basename($_SERVER['PHP_SELF']) == 'profileAdmin') ? 'active' : '' ?>">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#people-circle" />
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'logout.php' ? 'active' : '' ?>">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#box-arrow-right" />
                                </svg>
                                Sign out
                            </a>
                        </li>
                    </ul>
                    <br>
                </div>
            </nav>
        </div>
    </div>