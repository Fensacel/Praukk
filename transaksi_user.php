<?php
session_start();
include 'config.php';

$barang = mysqli_query($conn, "SELECT * FROM barang");

if (isset($_POST['simpan'])) {
    $kode_brg       = $_POST['kode_brg'];
    $kode_transaksi = $_POST['kdtr'];
    $jumlah         = (int) $_POST['jumlah'];
    $user           = $_SESSION['username'];

    // Ambil data barang
    $b = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_brg, harga, jumlah FROM barang WHERE kode_brg='$kode_brg'"));
    $nama_brg = $b['nama_brg'];
    $harga    = $b['harga'];
    $stok     = $b['jumlah'];

    // Validasi stok
    if ($jumlah > $stok) {
        echo "<script>alert('Stok tidak mencukupi!'); window.location='transaksi.php';</script>";
        exit;
    }

    $total = $harga * $jumlah;

    // Simpan transaksi
    mysqli_query($conn, "INSERT INTO transaksi (kode_brg, kode_transaksi, nama_brg, jumlah, username, total_bayar) 
                         VALUES ('$kode_brg','$kode_transaksi', '$nama_brg', '$jumlah', '$user', '$total')");

    // Update stok
    mysqli_query($conn,"UPDATE barang SET jumlah = jumlah - $jumlah WHERE kode_brg='$kode_brg'");

    echo "<script>alert('Transaksi berhasil!'); window.location='riwayat.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buat Transaksi</title>
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
  <h3>Buat Transaksi</h3>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Kode Transaksi</label>
      <input type="number" name="kdtr" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Pilih Barang</label>
      <select name="kode_brg" class="form-control" required>
        <option value="">-- Pilih --</option>
        <?php while($row=mysqli_fetch_assoc($barang)){ ?>
          <option value="<?= $row['kode_brg'] ?>"><?= $row['nama_brg'] ?> (Stok: <?= $row['jumlah']?>)</option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Jumlah</label>
      <input type="number" name="jumlah" class="form-control" required min="1">
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index_user.php" class="btn btn-danger">Back</a>
  </form>
</div>
</body>
</html>
