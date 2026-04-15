<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_manajemen_obat";
$port = "3309";

$conn = new mysqli($hostname, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Gagal: " . $conn->connect_error);
}

function dd($data)
{
    echo "<pre>";
    print_r($data);
    die;
}
