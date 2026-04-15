<?php
include "koneksi.php";
// dd($_POST);

$namaObat = $_POST['nama_obat'];
$dosis = $_POST['dosis'];
$jumlah = $_POST['jumlah'];
$kategori = $_POST['kategori'];
$caraKonsumsi = $_POST['cara_penggunaan'];
$efekSamping = isset($_POST['efek_samping']) ? implode("||", $_POST['efek_samping']) : null;
$tglKadaluarsa = $_POST['tgl_kadaluarsa'];
$catatan = $_POST['catatan'];
$resepdokter = $_POST['resep_dokter'] == 1 ? TRUE : FALSE;
$frekuensi = $_POST['frekuensi_pemakaian'];

$query = $conn->query("INSERT INTO obat
(user_id, nama_obat, dosis, jumlah, kategori , cara_penggunaan, efek_samping, tanggal_kadaluarsa, catatan, resep_dokter, frekuensi_pemakaian)
values (1, '$namaObat', '$dosis', $jumlah, '$kategori' , '$caraKonsumsi', '$efekSamping', '$tglKadaluarsa', '$catatan', '$resepdokter', $frekuensi)");

header("location:dashboard.php");
