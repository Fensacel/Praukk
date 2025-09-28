<?php
include 'config.php';
$result = mysqli_query($conn, "SELECT t.*, b.nama_brg, b.harga 
                               FROM transaksi t 
                               JOIN barang b ON t.kode_brg=b.kode_brg
                               ORDER BY t.kode_transaksi DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Transaksi</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<style>
  .nav-link {
    color: white !important;
  }
  .nav-link.active {
    color: #ffffffff !important;
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
  <h2>Data Transaksi</h2>
  <a href="tambah_transaksi.php" class="btn btn-primary mb-3">Tambah Transaksi</a>
  <table class="table table-bordered">
    <tr class="table-dark">
      <th>No</th>
      <th>Kode Transaksi</th>
      <th>User</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
    <?php 
    $no=1;
    while($row=mysqli_fetch_assoc($result)){ ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['kode_transaksi'] ?></td>
      <td><?= $row['username']?></td>
      <td><?= $row['nama_brg'] ?></td>
      <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
      <td><?= $row['jumlah'] ?></td>
      <td>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
      <td>
        <a href="edit_transaksi.php?id=<?= $row['kode_transaksi'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete_transaksi.php?id=<?= $row['kode_transaksi'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>
<script>
  function confirmLogout(event) {
    if (!confirm("Apakah Anda yakin ingin logout?")) {
      event.preventDefault();
    }
  }
</script>
</body>
</html>
