<?php
if (!isset($_GET['id'])) {
    echo "sabar";
    die;
}

$id = $_GET['id'];
include "koneksi.php";
$query = $conn->query("SELECT * FROM obat WHERE id = $id");

if (mysqli_num_rows($query) == 0) {
    echo "sabar 2";
    die;
}

$data = mysqli_fetch_assoc($query);
$es = explode("||", $data['efek_samping']);

?>

<?php include 'main/head.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row m-4">
        <h1 class="modal-title fs-4 mb-2 fw-bold text-center"><i class="fa fa-pencil"></i> Edit obat</h1>
        <div class="card">
            <div class="card-body">
                <form action="update.php?why=<?= $id ?>" method="post">
                    <div class="mb-2">
                        <label for="nama" class="col-form-label">Nama Obat</label>
                        <input value="<?= $data['nama_obat'] ?>" type="text" name="nama_obat" placeholder="Ex. Paracetamol" class="form-control" id="nama" required pattern=".*\S.*">
                    </div>
                    <div class="row mb-2 g-4">
                        <div class="col">
                            <label for="dosis" class="col-form-label">Dosis</label>
                            <input value="<?= $data['dosis'] ?>" type="text" name="dosis" placeholder="Ex. 100mg" class="form-control" id="dosis" required pattern=".*\S.*">
                        </div>
                        <div class="col">
                            <label for="jumlah" class="col-form-label">Jumlah</label>
                            <input value="<?= $data['jumlah'] ?>" type="number" name="jumlah" class="form-control" id="jumlah" required min="0" max="1000">
                        </div>
                        <div class="col">
                            <label for="kategori" class="col-form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option <?= $data['kategori'] == 'Tablet' ? 'selected' : '' ?> value="Tablet">Tablet</option>
                                <option <?= $data['kategori'] == 'Sirup' ? 'selected' : '' ?> value="Sirup">Sirup</option>
                                <option <?= $data['kategori'] == 'Kapsul' ? 'selected' : '' ?> value="Kapsul">Kapsul</option>
                                <option <?= $data['kategori'] == 'Salep' ? 'selected' : '' ?> value="Salep">Salep</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2 g-4">
                        <div class="col-4">
                            <label for="frekuensi_pemakaian" class="col-form-label">Pemakaian (per hari)</label><br>
                            <input value="<?= $data['frekuensi_pemakaian'] ?>" type="number" name="frekuensi_pemakaian" class="form-control" min="1" required>
                        </div>
                        <div class="col-4">
                            <label for="tgl_kadaluarsa" class="col-form-label">Tgl. kadaluarsa</label>
                            <input value="<?= $data['tanggal_kadaluarsa'] ?>" type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control" required min="<?= $data['tanggal_kadaluarsa'] ?>">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="resep_dokter" class="col-form-label">Resep dokter</label><br>
                        <input <?= $data['resep_dokter'] ? 'checked' : '' ?> type="radio" class="form-check-input" name="resep_dokter" value="1" required> Ya
                        <input <?= $data['resep_dokter'] ? '' : 'checked' ?> type="radio" class="form-check-input ms-5" name="resep_dokter" value="0"> Tidak
                    </div>
                    <div class="mb-2">
                        <label class="col-form-label">Cara Penggunaan</label><br>
                        <input <?= $data['cara_penggunaan'] == 'Sebelum Makan' ? 'checked' : '' ?> type="radio" class="form-check-input" name="cara_penggunaan" value="Sebelum Makan" required> Sebelum Makan
                        <input <?= $data['cara_penggunaan'] == 'Sesudah Makan' ? 'checked' : '' ?> type="radio" class="form-check-input ms-4" name="cara_penggunaan" value="Sesudah Makan"> Sesudah Makan
                        <input <?= $data['cara_penggunaan'] == 'Oles pada area sakit' ? 'checked' : '' ?> type="radio" class="form-check-input ms-4" name="cara_penggunaan" value="Oles pada area sakit"> Oles pada area sakit
                    </div>
                    <div class="mb-2">
                        <label class="col-form-label">Efek samping</label><br>
                        <input <?= in_array('Pusing', $es) ? 'checked' : '' ?> type="checkbox" class="form-check-input" name="efek_samping[]" value="Pusing"> Pusing
                        <input <?= in_array('Diare', $es) ? 'checked' : '' ?> type="checkbox" class="form-check-input ms-4" name="efek_samping[]" value="Diare"> Diare
                        <input <?= in_array('Muntah', $es) ? 'checked' : '' ?> type="checkbox" class="form-check-input ms-4" name="efek_samping[]" value="Muntah"> Muntah
                        <input <?= in_array('Lainnya', $es) ? 'checked' : '' ?> type="checkbox" class="form-check-input ms-4" name="efek_samping[]" value="Lainnya"> Lainnya <br>
                    </div>
                    <div class="mb-2">
                        <label for="catatan" class="col-form-label">Resep Dokter/Catatan</label>
                        <textarea name="catatan" id="catatan" class="form-control"><?= $data['catatan'] ?></textarea>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?php include 'main/foot.php'; ?>