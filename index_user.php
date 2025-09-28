<?php
session_start();
include 'config.php';

// Cek apakah user sudah login dan levelnya user
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'user') {
    header("Location: login.php");
    exit();
}
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
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
