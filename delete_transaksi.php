<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi='$id'"));
    $kode_brg = $transaksi['kode_brg'];
    $jumlah   = $transaksi['jumlah'];
    mysqli_query($conn, "UPDATE barang SET jumlah = jumlah + $jumlah WHERE kode_brg='$kode_brg'");
    mysqli_query($conn, "DELETE FROM transaksi WHERE kode_transaksi='$id'");

    header("Location: transaksi.php");
    exit;
} else {
    echo "ID transaksi tidak ditemukan!";
}
?>
