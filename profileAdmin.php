<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit;
}

$id = (int) $_SESSION['id'];

$query = mysqli_query($conn, "SELECT * FROM users");

?>

<?php include 'main/head.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4">
                <div class="m-3 mb-0">
                    <h4 class="mb-0 fw-bold">All Profile</h4>
                </div>
                <div class="card-body text-center">
                    <table class="table w-100 table-bordered" id="tbl-profile">
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nama lengkap</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1;
                        while ($d = mysqli_fetch_assoc($query)) {
                            $no_pasien = 'PSN-' . str_pad($d['id'], 4, '0', STR_PAD_LEFT);
                        ?>
                            <tr>
                                <td><?= $no ?>.</td>
                                <td><?= $d['username'] ?></td>
                                <td><?= $d['nama_lengkap'] ?></td>
                                <td><a href="profile.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </table>

                </div>
            </div>

        </div>
    </div>
</main>

<?php include 'main/foot.php'; ?>