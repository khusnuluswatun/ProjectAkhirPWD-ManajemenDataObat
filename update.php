<?php
session_start();
include "koneksi.php";

$user_id = $_SESSION['id']; 

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

if ($_GET['why'] == 'save') {
    $query = $conn->query("INSERT INTO obat
            (user_id, nama_obat, dosis, jumlah, kategori , cara_penggunaan, efek_samping, tanggal_kadaluarsa, catatan, resep_dokter, frekuensi_pemakaian)
            values ($user_id, '$namaObat', '$dosis', $jumlah, '$kategori' , '$caraKonsumsi', '$efekSamping', '$tglKadaluarsa', '$catatan', '$resepdokter', $frekuensi)");
} else { 
    $id = $_GET['why'];
    $query = $conn->query("UPDATE obat SET
                            nama_obat = '$namaObat'
                            , dosis = '$dosis'
                            , jumlah = $jumlah
                            , kategori  = '$kategori'
                            , cara_penggunaan = '$caraKonsumsi'
                            , efek_samping = '$efekSamping'
                            , tanggal_kadaluarsa = '$tglKadaluarsa'
                            , catatan = '$catatan'
                            , resep_dokter = '$resepdokter'
                            , frekuensi_pemakaian = $frekuensi
                            where id = $id
                            ");
}

header("location:dashboard.php?status=success");
