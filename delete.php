<?php
include "config.php";

if (!isset($_GET['id'])) {
    die("Error: ID tidak ditemukan.");
}

$id = $_GET['id'];

$query = "DELETE FROM barang WHERE kode_brg='$id'";

mysqli_query($conn, $query) or die(mysqli_error($conn));

header("Location: index.php");
exit;
?>
