<?php
session_start();
include 'config.php';
$result = mysqli_query($conn, "SELECT t.*, b.nama_brg, b.harga 
                               FROM transaksi t 
                               JOIN barang b ON t.kode_brg=b.kode_brg
                               ORDER BY t.kode_transaksi DESC");    
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard User</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .nav-link { color: white !important; }
    .nav-link.active { font-weight: bold; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="nav justify-content-center bg-dark">
    <a class="nav-link active" href="index_user.php">Home</a>
    <a class="nav-link active" href="transaksi_user.php">Buat Transaksi</a>
    <a class="nav-link active" href="daftar_barang.php">Lihat Barang</a>
    <a class="nav-link active" href="riwayat.php">Riwayat Transaksi</a>
    <a class="nav-link active" class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin logout?')">Log Out</a>
  </nav>

  <!-- Konten -->
  <div class="container mt-4">
    <div class="card shadow-lg rounded-3">
      <div class="card-body">
        <h3>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?> 👋</h3>
        <h2>Data Transaksi</h2>
  <table class="table table-bordered">
    <tr class="table-dark">
      <th>No</th>
      <th>Kode Transaksi</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Total</th>
    </tr>
    <?php
    $no=1;
    while($row=mysqli_fetch_assoc($result)){ ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['kode_transaksi'] ?></td>
      <td><?= $row['nama_brg'] ?></td>
      <td><?= number_format($row['harga']) ?></td>
      <td><?= $row['jumlah'] ?></td>
      <td>Rp <?= number_format($row['total_bayar']) ?></td>
      
    </tr>
    <?php } ?>
  </table>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
