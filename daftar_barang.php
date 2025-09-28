<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'user') {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Barang</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .nav-link { color: white !important; }
    .nav-link.active { font-weight: bold; }
  </style>
</head>
<body>
    <nav class="nav justify-content-center bg-dark">
    <a class="nav-link active" href="index_user.php">Home</a>
    <a class="nav-link active" href="transaksi_user.php">Buat Transaksi</a>
    <a class="nav-link active" href="daftar_barang.php">Lihat Barang</a>
    <a class="nav-link active" href="riwayat.php">Riwayat Transaksi</a>
    <a class="nav-link active" class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin logout?')">Log Out</a>
  </nav>
<div class="container mt-4">
  <h3>Daftar Barang</h3>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Merk</th>
        <th>Harga</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['kode_brg'] ?></td>
        <td><?= $row['nama_brg'] ?></td>
        <td><?= $row['merk'] ?></td>
        <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
        <td><?= $row['jumlah'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
