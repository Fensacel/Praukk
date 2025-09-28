<?php

include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM barang");

if (!$result) {
    die("Query error: " . mysqli_error($conn));
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
    <h1>Sistem Penjualan</h1>
    <a href="tambahb.php"><button class="btn btn-primary mb-3">Tambah Barang</button></a>
    <table class="table table-bordered">
      <thead>
        <tr class="table-dark">
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Merk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
  <?php $no = 1; while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['kode_brg'] ?></td>
      <td><?= $row['nama_brg'] ?></td>
      <td><?= $row['merk'] ?></td>
      <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
      <td><?= $row['jumlah'] ?></td>
      <td>
        <a href="edit.php?id=<?= $row['kode_brg'] ?>" class="btn btn-warning">Edit</a>
        <a href="delete.php?id=<?= $row['kode_brg'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger">Hapus</a>
      </td>
    </tr>
  <?php } ?>
<?php else: ?>
  <tr>
    <td colspan="7" class="text-center">Data barang belum ada</td>
  </tr>
<?php endif; ?>
      </tbody>
    </table>
  </div>
  <script>
    function confirmLogout(event) {
      if (!confirm("Apakah Anda yakin ingin logout?")) {
        event.preventDefault();
      }
    }
  </script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>