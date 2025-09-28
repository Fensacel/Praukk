<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sipenjualan_pahri";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
