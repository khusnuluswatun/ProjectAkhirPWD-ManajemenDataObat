<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit;
} elseif (isset($_GET['id']) && $_GET['id']) {
    $id = (int) $_GET['id'];
} else {
    $id = (int) $_SESSION['id'];
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$data = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) == 0) {
    $redirect = $_SESSION['role'] == 'admin' ? 'profileAdmin' : 'profile';
    echo "<script>
    alert('Data profile tidak ditemukan');
    window.location.href='" . $redirect . ".php';
    </script>";
    exit;
}

$no_pasien = 'PSN-' . str_pad($data['id'], 4, '0', STR_PAD_LEFT);
?>

<?php include 'main/head.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">
                <div class="card-body text-center">

                    <img src="assets/img/profile.png" width="80" class="mb-3">

                    <h4 class="mb-1"><?= htmlspecialchars(strtoupper($data['nama_lengkap'])) ?></h4>
                    <hr>
                    <div class="text-start">
                        <p>
                            <img src="assets/img/id.png" width="20" style="vertical-align:middle; margin-right:5px;">
                            <b>ID Pengguna:</b><br>
                            <?= $no_pasien ?>
                        </p>

                        <p>
                            <img src="assets/img/email.png" width="20" style="vertical-align:middle; margin-right:5px;">
                            <b> Email:</b><br>
                            <?= htmlspecialchars($data['email']) ?>
                        </p>

                        <p>
                            <img src="assets/img/gabung.png" width="20" style="vertical-align:middle; margin-right:5px;">
                            <b>Bergabung:</b><br>
                            <?= $data['created_at'] ?>
                        </p>

                    </div>

                    <a href="editprofile.php?id=<?= $id ?>" class="btn btn-primary w-100 mt-3">
                        Edit Profil
                    </a>

                </div>
            </div>

        </div>
    </div>

</main>

<?php include 'main/foot.php'; ?>