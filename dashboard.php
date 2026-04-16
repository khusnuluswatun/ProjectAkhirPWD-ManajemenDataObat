<?php
$id = 1;
include "koneksi.php";
$query = $conn->query("SELECT * FROM obat WHERE user_id = $id");
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

$akanKadaluarsa = $sudahKadaluarsa = 0;
$stokTersedia = count($data);
$today = new DateTime();
$nextMonth = (new DateTime())->modify('+2 week');

foreach ($data as $item => $v) {
    $expired = new DateTime($v['tanggal_kadaluarsa']);
    if ($expired < $today) {
        $sudahKadaluarsa++;
    } elseif ($expired <= $nextMonth) {
        $akanKadaluarsa++;
    }

    if ($v['jumlah'] == 0) {
        $stokTersedia--;
    }
}

?>

<?php include 'main/head.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row mt-3">
        <div class="col">
            <div class="card" style="border-left: 4px solid blue;height:100%">
                <div class="card-body">
                    <div class="card-img-div">
                        <img src="https://cdn-icons-png.flaticon.com/512/679/679821.png" alt="">
                    </div>
                    <span class="card-count"><?= $query->num_rows; ?></span><br>
                    <span class="card-text">Total obat</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="border-left: 4px solid green;height:100%">
                <div class="card-body">
                    <div class="card-img-div">
                        <img src="https://cdn-icons-png.flaticon.com/512/6345/6345324.png" alt="">
                    </div>
                    <span class="card-count"><?= $stokTersedia ?></span><br>
                    <span class="card-text">Stok Tersedia</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="border-left: 4px solid orange;height:100%">
                <div class="card-body">
                    <div class="card-img-div">
                        <img src="https://cdn-icons-png.flaticon.com/512/6314/6314755.png" alt="">
                    </div>
                    <span class="card-count"><?= $akanKadaluarsa ?></span><br>
                    <span class="card-text">Akan kadaluarsa (< 14 hari) </span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="border-left: 4px solid red;height:100%">
                <div class="card-body">
                    <div class="card-img-div">
                        <img src="https://cdn-icons-png.flaticon.com/512/4201/4201973.png" alt="">
                    </div>
                    <span class="card-count"><?= $sudahKadaluarsa ?></span><br>
                    <span class="card-text">Sudah kadaluarsa</span>
                </div>
            </div>
        </div>
    </div>
    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <div class="card my-3">
        <div class="card-body">
            <div class="d-flex justify-content-between mt-2 mb-4">
                <h3>Data Obat</h3>
                <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#mdlTambahObat"><i class="fa fa-plus"></i> Tambah Obat</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tbl-dataObat">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th>Jumlah</th>
                            <th>Cara Konsumsi</th>
                            <th>Efek Samping</th>
                            <th>Tanggal Expired</th>
                            <th>Catatan</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $d) { ?>
                            <tr>
                                <td class="text-center"><?= $no ?>.</td>
                                <td><?= $d['nama_obat'] ?></td>
                                <td><?= $d['dosis'] ?></td>
                                <td><?= $d['jumlah'] ?></td>
                                <td><?= $d['cara_penggunaan'] ?></td>
                                <td><?= $d['efek_samping'] ? str_replace("||", ", ", $d['efek_samping']) : '-' ?></td>
                                <td><?= $d['tanggal_kadaluarsa'] ?></td>
                                <td><?= $d['catatan'] ? $d['catatan'] : '-' ?></td>
                                <td class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-sm btn-info" title="Detail obat" onclick="alert('proses')"><i class="fa fa-book"></i></button>
                                    <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning ms-2" title="Edit obat"><i class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="deleteObat(<?= $d['id'] ?>)" title="Hapus obat"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade modal-lg" id="mdlTambahObat" tabindex="-1" aria-labelledby="mdlTambahObatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-2">
            <form action="update.php?why=save" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="mdlTambahObatLabel"><i class="fa fa-plus"></i> Tambah obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="nama" class="col-form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" placeholder="Ex. Paracetamol" class="form-control" id="nama" required pattern=".*\S.*">
                    </div>
                    <div class="row mb-2 g-4">
                        <div class="col">
                            <label for="dosis" class="col-form-label">Dosis</label>
                            <input type="text" name="dosis" placeholder="Ex. 100mg" class="form-control" id="dosis" required pattern=".*\S.*">
                        </div>
                        <div class="col">
                            <label for="jumlah" class="col-form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" required min="1" max="1000">
                        </div>
                        <div class="col">
                            <label for="kategori" class="col-form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="" selected disabled>Pilih kategori</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Sirup">Sirup</option>
                                <option value="Kapsul">Kapsul</option>
                                <option value="Salep">Salep</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2 g-4">
                        <div class="col-4">
                            <label for="frekuensi_pemakaian" class="col-form-label">Pemakaian (per hari)</label><br>
                            <input type="number" name="frekuensi_pemakaian" class="form-control" min="1" required>
                        </div>
                        <div class="col-4">
                            <label for="tgl_kadaluarsa" class="col-form-label">Tgl. kadaluarsa</label>
                            <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control" required min="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="resep_dokter" class="col-form-label">Resep dokter</label><br>
                        <input type="radio" class="form-check-input" name="resep_dokter" value="1" required> Ya
                        <input type="radio" class="form-check-input ms-5" name="resep_dokter" value="0"> Tidak
                    </div>
                    <div class="mb-2">
                        <label class="col-form-label">Cara Penggunaan</label><br>
                        <input type="radio" class="form-check-input" name="cara_penggunaan" value="Sebelum Makan" required> Sebelum Makan
                        <input type="radio" class="form-check-input ms-4" name="cara_penggunaan" value="Sesudah Makan"> Sesudah Makan
                        <input type="radio" class="form-check-input ms-4" name="cara_penggunaan" value="Oles pada area sakit"> Oles pada area sakit
                    </div>
                    <div class="mb-2">
                        <label class="col-form-label">Efek samping</label><br>
                        <input type="checkbox" class="form-check-input" name="efek_samping[]" value="Pusing"> Pusing
                        <input type="checkbox" class="form-check-input ms-4" name="efek_samping[]" value="Diare"> Diare
                        <input type="checkbox" class="form-check-input ms-4" name="efek_samping[]" value="Muntah"> Muntah
                        <input type="checkbox" class="form-check-input ms-4" name="efek_samping[]" value="Lainnya"> Lainnya <br>
                    </div>
                    <div class="mb-2">
                        <label for="catatan" class="col-form-label">Resep Dokter/Catatan</label>
                        <textarea name="catatan" id="catatan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'main/foot.php'; ?>

<?php if (isset($_GET['status'])): ?>
    <script>
        Swal.fire({
            icon: '<?= $_GET['status']; ?>',
            title: 'Berhasil !'
        });
        window.history.replaceState({}, document.title, window.location.pathname);
    </script>
<?php endif; ?>