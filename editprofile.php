<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$data = mysqli_fetch_assoc($query);
?>

<?php include 'main/head.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">

<div class="card p-4 shadow-sm">
    <div class="d-flex align-items-center gap-2 mb-4">
        <img src="assets/img/editprofile.png" width="40">
        <h4 class="mb-0 fw-bold">Edit Profile</h4>
    </div>

    <form method="POST">

        <!-- NAMA -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                   value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>

        <!-- GRID -->
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control"
                       value="<?= htmlspecialchars($data['no_hp']) ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control"
                       value="<?= $data['tgl_lahir'] ?>" required>
            </div>

        </div>

        <!-- ALAMAT -->
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>

        <!-- PASSWORD -->
        <div class="mb-3">
            <label class="form-label">Password Baru (opsional)</label>
            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
        </div>

        <!-- BUTTON -->
        <div class="text-center mt-4">
            <button type="submit" name="update" class="btn btn-primary px-4">
                Save changes
            </button>
        </div>

    </form>
</div>

</main>

<?php include 'main/foot.php'; ?>


<?php
if(isset($_POST['update'])){
    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $tgl = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    // update data utama
    mysqli_query($conn, "UPDATE users SET
        nama_lengkap='$nama',
        email='$email',
        no_hp='$no_hp',
        tgl_lahir='$tgl',
        alamat='$alamat'
        WHERE id=$id
    ");

    // update password kalau diisi
    if(!empty($_POST['password'])){
        $pass = md5($_POST['password']);
        mysqli_query($conn, "UPDATE users SET password='$pass' WHERE id=$id");
    }

    // update session
    $_SESSION['nama_lengkap'] = $nama;

    echo "<script>
        alert('Profil berhasil diupdate');
        window.location='profile.php';
    </script>";
}
?>