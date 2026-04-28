<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit;
} elseif (isset($_GET['id']) && $_GET['id']) {
    $id = (int) $_GET['id'];
} else {
    header("location: profile.php");
    exit;
}

if ($_SESSION['role'] == 'user' && ($id != $_SESSION['id'])) {
    echo "<script>
    alert('Pelanggaran! Kamu user biasa tapi mau edit profile user lain');
    window.location.href='profile.php';
    </script>";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    $redirect = $_SESSION['role'] == 'admin' ? 'profileAdmin' : 'profile';
    echo "<script>
alert('Data profile tidak ditemukan');
window.location.href='" . $redirect . ".php';
</script>";
    exit;
}
?>

<?php include 'main/head.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 my-4">

    <div class="card p-4 shadow-sm">
        <div class="d-flex align-items-center gap-2 mb-4">
            <img src="assets/img/editprofile.png" width="40">
            <h4 class="mb-0 fw-bold">Edit Profile</h4>
        </div>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">ID Pengguna</label>
                <input type="text" name="id_pengguna" class="form-control" readonly
                    value="<?= 'PSN-' . str_pad($data['id'], 4, '0', STR_PAD_LEFT) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" readonly
                    value="<?= $data['username'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" pattern=".*\S.*" minlength="5"
                    value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= htmlspecialchars($data['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password Baru (opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah" pattern=".*\S.*" minlength="3">
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="update" class="btn btn-primary px-4">
                    Save changes
                </button>
            </div>

        </form>
    </div>
</main>


<?php
include 'main/foot.php';

if (isset($_POST['update'])) {
    $nama = $_POST['nama_lengkap'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE users SET
        nama_lengkap='$nama',
        email='$email'
        WHERE id=$id
    ");

    if (!empty($_POST['password'])) {
        $pass = md5($_POST['password']);
        mysqli_query($conn, "UPDATE users SET password='$pass' WHERE id=$id");
    }


    $_SESSION['nama_lengkap'] = $nama;

    echo "<script>
        Swal.fire({
                        title: 'Success',
                        text: 'Profil berhasil diupdate',
                        icon: 'success'
                    }).then((r) => { window.location='profile.php?id=" . $id . "'; });
        
    </script>";
}

?>