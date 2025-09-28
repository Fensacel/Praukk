<?php
include 'config.php';

if(isset($_POST['simpan'])){
    $kode_brg = $_POST['kode_brg'];
    $nama_brg = $_POST['nama_brg'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($conn,"INSERT INTO barang (kode_brg,nama_brg,merk,harga,jumlah) VALUES('$kode_brg','$nama_brg','$merk','$harga','$jumlah')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Penjualan UKK</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<style>
  .nav-link {
    color: white !important;
  }
  .nav-link.active {
    color: #ffffffff !important; /* kuning saat aktif (opsional) */
    font-weight: bold;
  }
</style>
<body>
    <nav class="nav justify-content-center bg-dark">
      <a class="nav-link active" href="index.php">Home</a>
      <a class="nav-link active" href="tambahb.php">Tambah</a>
      <a class="nav-link active" href="transaksi.php">Transaksi</a>
      <a class="nav-link active" href="logout.php" onclick="confirmLogout(event)">Log Out</a>
    </nav>
  <div class="container mt-4">
    <h1>Tambah Barang</h1>
    <form action="" method="POST">
        <div class="col-4 mb-3">
            <label for="">Kode Barang</label>
            <input class="form-control" type="text" name="kode_brg" id="">
        </div>
        <div class="col-4 mb-3">
            <label for="">Nama Barang</label>
            <input class="form-control" type="text" name="nama_brg" id="">
        </div>
        <div class="col-4 mb-3">
            <label for="">Merk</label>
            <input class="form-control" type="text" name="merk" id="">
        </div>
        <div class="col-4 mb-3">
            <label for="">Harga</label>
            <input class="form-control" type="text" name="harga" id="">
        </div>
        <div class="col-4 mb-3">
            <label for="">Jumlah</label>
            <input class="form-control" type="text" name="jumlah" id="">
        </div>
        <button  class="btn btn-success"type="submit" name="simpan">Save</button>
        <a href="index.php" class="btn btn-danger">Back</a>
    </form>
  </div>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>