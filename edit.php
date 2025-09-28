<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Error: ID tidak ditemukan.");
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM barang WHERE kode_brg='$id'");

if (mysqli_num_rows($result) == 0) {
    die("Error: Data tidak ditemukan.");
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $kode_brg = $_POST['kode_brg'];
    $nama_brg = $_POST['nama_brg'];
    $merk     = $_POST['merk'];
    $harga    = $_POST['harga'];
    $jumlah   = $_POST['jumlah'];

    $query = "UPDATE barang 
              SET nama_brg='$nama_brg', merk='$merk', harga='$harga', jumlah='$jumlah' 
              WHERE kode_brg='$kode_brg'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Penjualan UKK</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
  .nav-link {
    color: white !important;
  }
  .nav-link.active {
    color: #ffffffff !important;
    font-weight: bold;
  }
</style>
</head>
<body>
        <nav class="nav justify-content-center bg-dark">
      <a class="nav-link active" href="index.php">Home</a>
      <a class="nav-link active" href="tambahb.php">Tambah</a>
      <a class="nav-link active" href="transaksi.php">Transaksi</a>
      <a class="nav-link active" href="logout.php" onclick="confirmLogout(event)">Log Out</a>
    </nav>

  <div class="container">
    <h1>Edit Barang</h1>
    <form action="" method="POST">
        <div class="col-4 mb-3">
            <label for="">Kode Barang</label>
            <input class="form-control" value="<?= $row['kode_brg']?>" type="text" disabled readonly>
            <input type="hidden" name="kode_brg" value="<?= $row['kode_brg']?>">
        </div>
        <div class="col-4 mb-3">
            <label for="">Nama Barang</label>
            <input class="form-control" value="<?= $row['nama_brg']?>" type="text" name="nama_brg">
        </div>
        <div class="col-4 mb-3">
            <label for="">Merk</label>
            <input class="form-control" value="<?= $row['merk']?>" type="text" name="merk">
        </div>
        <div class="col-4 mb-3">
            <label for="">Harga</label>
            <input class="form-control" value="<?= $row['harga']?>" type="text" name="harga">
        </div>
        <div class="col-4 mb-3">
            <label for="">Jumlah</label>
            <input class="form-control" value="<?= $row['jumlah']?>" type="text" name="jumlah">
        </div>
        <button class="btn btn-success" type="submit" name="update">Update</button>
        <a href="index.php" class="btn btn-danger">Back</a>
    </form>
  </div>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
