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
// dd($data);

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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Khusnul">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="assets/logo1.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins';
        }

        .blu {
            background-color: white;
        }

        .shadow {
            box-shadow: 0 0 0.7rem 0.06rem rgba(0, 0, 0, 0.15) !important;
        }

        .card {
            border: 1px solid gray;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .card-img-div {
            width: 37px;
            height: 37px;
            border-radius: 10px;
            background-color: #d6d6d68a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            /* margin-bottom: 5px; */
        }

        .card-img-div img {
            width: 27px;
        }

        .card-count {
            font-size: 40px;
            font-weight: bold;
        }

        .card-text {
            font-size: 12px;
        }

        #tbl-dataObat {
            border-radius: 12px;
        }

        #tbl-dataObat th {
            background-color: #6caeed;
            vertical-align: middle;
        }

        .modal label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="speedometer2" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z" />
            <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z" />
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol id="grid" viewBox="0 0 16 16">
            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
        </symbol>
    </svg>

    <header class="navbar sticky-top bg-light flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 blu" href="#">
            <img src="assets/logo1.png" width="30">
            <b style="color:blue">Medi</b><b style="color:green">Track</b>
        </a>
        <!-- <input class="form-control form-control w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#"><i class="fa fa-sign-out"></i> Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page" href="#">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link-dark" href="#">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#grid" />
                                </svg>
                                Products
                            </a>
                        </li>
                    </ul>
                    <br>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Profile</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a href="#" class="nav-link link-dark" href="#">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#people-circle" />
                                </svg>
                                Account
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card" style="border-left: 4px solid green;height:100%">
                            <div class="card-body">
                                <div class="card-img-div">
                                    <img src="assets/logo1.png" alt="">
                                </div>
                                <span class="card-count"><?= $query->num_rows; ?></span><br>
                                <span class="card-text">Total obat</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="border-left: 4px solid blue;height:100%">
                            <div class="card-body">
                                <div class="card-img-div">
                                    <img src="assets/logo1.png" alt="">
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
                                    <img src="assets/logo1.png" alt="">
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
                                    <img src="assets/logo1.png" alt="">
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
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#mdlTambahObat"><i class="fa fa-plus"></i> Tambah Obat</button>
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
                                            <td><?= $no ?></td>
                                            <td><?= $d['nama_obat'] ?></td>
                                            <td><?= $d['dosis'] ?></td>
                                            <td><?= $d['jumlah'] ?></td>
                                            <td><?= $d['cara_penggunaan'] ?></td>
                                            <td><?= $d['efek_samping'] ? str_replace("||", ", ", $d['efek_samping']) : '-' ?></td>
                                            <td><?= $d['tanggal_kadaluarsa'] ?></td>
                                            <td><?= $d['catatan'] ? $d['catatan'] : '-' ?></td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-sm btn-info" title="Detail obat"><i class="fa fa-book"></i></button>
                                                <button type="button" class="btn btn-sm btn-warning ms-2" title="Edit obat"><i class="fa fa-pencil"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger ms-2" title="Hapus obat"><i class="fa fa-trash"></i></button>
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="mdlTambahObat" tabindex="-1" aria-labelledby="mdlTambahObatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="update.php" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="mdlTambahObatLabel">Tambah obat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="nama" class="col-form-label">Nama Obat</label>
                            <input type="text" name="nama_obat" placeholder="Ex. Paracetamol" class="form-control" id="nama" required>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <label for="dosis" class="col-form-label">Dosis</label>
                                <input type="text" name="dosis" placeholder="Ex. 100mg" class="form-control" id="dosis" required>
                            </div>
                            <div class="col-3">
                                <label for="jumlah" class="col-form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" required min="1">
                            </div>
                            <div class="col-4">
                                <label for="kategori" class="col-form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="" selected disabled>Pilih kategori</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Sirup">Sirup</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Salep">Salep</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <label for="resep_dokter" class="col-form-label">Resep dokter</label><br>
                                <input type="radio" name="resep_dokter" value="1" required> Ya
                                <input type="radio" name="resep_dokter" value="0" class="ms-4"> Tidak
                            </div>
                            <div class="col-4">
                                <label for="frekuensi_pemakaian" class="col-form-label">Pemakaian (per hari)</label><br>
                                <input type="number" name="frekuensi_pemakaian" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label">Cara Penggunaan</label><br>
                            <input type="radio" name="cara_penggunaan" value="Sebelum Makan" required> Sebelum Makan
                            <input type="radio" name="cara_penggunaan" value="Sesudah Makan" class="ms-4"> Sesudah Makan
                            <input type="radio" name="cara_penggunaan" value="Oles pada area sakit" class="ms-4"> Oles pada area sakit
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label">Efek samping</label><br>
                            <input type="checkbox" name="efek_samping[]" value="Pusing"> Pusing
                            <input type="checkbox" name="efek_samping[]" value="Diare" class="ms-4"> Diare
                            <input type="checkbox" name="efek_samping[]" value="Muntah" class="ms-4"> Muntah
                            <input type="checkbox" name="efek_samping[]" value="Lainnya" class="ms-4"> Lainnya <br>
                        </div>
                        <div class="mb-2">
                            <label for="tgl_kadaluarsa" class="col-form-label">Tanggal kadaluarsa</label>
                            <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control" required min="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="mb-2">
                            <label for="catatan" class="col-form-label">Resep Dokter/Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.js"></script> -->
    <script>
        const modal = document.getElementById('mdlTambahObat');
        modal.addEventListener('hidden.bs.modal', function() {
            const form = modal.querySelector('form');
            form.reset();

            // reset input file
            form.querySelectorAll('input[type="file"]').forEach(input => {
                input.value = '';
            });
            form.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0;
            });
        });
    </script>
</body>

</html>