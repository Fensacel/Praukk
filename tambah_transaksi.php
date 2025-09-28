<?php
include 'config.php';

// ambil semua barang dari tabel barang
$barang = mysqli_query($conn,"SELECT * FROM barang");

if(isset($_POST['simpan'])){
    $kode_transaksi = $_POST['kdtr'];
    $kode_brg = $_POST['kode_brg'];
    $jumlah   = $_POST['jumlah'];

    // Ambil data barang
    $b = mysqli_fetch_assoc(mysqli_query($conn,"SELECT harga, jumlah FROM barang WHERE kode_brg='$kode_brg'"));
    $harga = $b['harga'];
    $stok  = $b['jumlah'];

    // Cek stok
    if($jumlah > $stok){
        echo "<script>alert('Stok tidak mencukupi! Stok tersisa: $stok'); window.location='tambah_transaksi.php';</script>";
        exit;
    }

    $total = $harga * $jumlah;

    mysqli_query($conn,"INSERT INTO transaksi(kode_transaksi, kode_brg, jumlah, total_bayar) 
                        VALUES('$kode_transaksi','$kode_brg','$jumlah','$total')");

    mysqli_query($conn,"UPDATE barang SET jumlah = jumlah - $jumlah WHERE kode_brg='$kode_brg'");

    header("Location: transaksi.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Transaksi</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
    .nav-link { color:white !important; }
    .nav-link.active { font-weight:bold; }
  </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="nav justify-content-center bg-dark">
      <a class="nav-link active" href="index.php">Home</a>
      <a class="nav-link active" href="tambahb.php">Tambah Barang</a>
      <a class="nav-link active" href="transaksi.php">Transaksi</a>
    </nav>

  <div class="container mt-4">
    <h2>Tambah Transaksi</h2>
    <form action="" method="POST">
        <!-- Pilih Barang -->
         <div class="col-6 mb-3">
          <label for="">Kode Transaksi</label>
          <input class="form-control" type="number" name="kdtr" id="kdtr" required>
        </div>
        <div class="col-6 mb-3">
          <label for="">Pilih Barang</label>
          <select name="kode_brg" id="barang" class="form-control" required onchange="updateInfo()">
            <option value="">-- Pilih Barang --</option>
            <?php while($row=mysqli_fetch_assoc($barang)){ ?>
              <option value="<?= $row['kode_brg']?>" data-harga="<?= $row['harga']?>" data-stok="<?= $row['jumlah']?>">
                <?= $row['kode_brg']?> - <?= $row['nama_brg']?> (Stok: <?= $row['jumlah']?>, Harga: <?= number_format($row['harga']) ?>)
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-6 mb-3">
          <label for="">Jumlah</label>
          <input class="form-control" type="number" name="jumlah" id="jumlah" required>
        </div>
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
        <a href="transaksi.php" class="btn btn-danger">Kembali</a>
    </form>
  </div>
<script src="assets/js/bootstrap.min.js"></scrip>
</body>
</html>
