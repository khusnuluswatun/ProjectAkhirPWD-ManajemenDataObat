<?php
include "koneksi.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("location:login.php");
    die;
}

if (isset($_GET) && $_GET['id']) {
    $id = $_GET['id'];
    $query = $conn->query("DELETE FROM obat WHERE id = $id");

    if ($query && $conn->affected_rows > 0) {
        echo json_encode([
            "status" => "success",
            "message" => "Data berhasil dihapus"
        ]);
        die;
    }
}
echo json_encode([
    "status" => "error",
    "message" => "Gagal menghapus data!"
]);
