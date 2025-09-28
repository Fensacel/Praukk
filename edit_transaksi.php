<?php
include 'config.php';

$kode_transaksi = $_GET['id'];

// ambil data transaksi
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'");
$transaksi = mysqli_fetch_assoc($query);

if (!$transaksi) {
    die("Data transaksi tidak ditemukan");
}

// ambil semua data barang
$barang = mysqli_query($conn, "SELECT * FROM barang");

// proses update
if (isset($_POST['update'])) {
    $kode_brg = $_POST['kode_brg'];
    $jumlah   = $_POST['jumlah'];

    // jumlah lama sebelum edit
    $jumlah_lama = $transaksi['jumlah'];
    $kode_brg_lama = $transaksi['kode_brg'];

    // kembalikan stok lama barang
    mysqli_query($conn, "UPDATE barang SET jumlah = jumlah + $jumlah_lama WHERE kode_brg='$kode_brg_lama'");

    // ambil harga barang baru
    $brg = mysqli_query($conn, "SELECT * FROM barang WHERE kode_brg='$kode_brg'");
    $data_brg = mysqli_fetch_assoc($brg);

    if ($data_brg) {
        // kurangi stok sesuai jumlah baru
        mysqli_query($conn,"UPDATE barang SET jumlah = jumlah - $jumlah WHERE kode_brg='$kode_brg'");

        $total_bayar = $data_brg['harga'] * $jumlah;

        $update = mysqli_query($conn, "UPDATE transaksi 
                                       SET kode_brg='$kode_brg',
                                           jumlah='$jumlah',
                                           total_bayar='$total_bayar'
                                       WHERE kode_transaksi='$kode_transaksi'");

        if ($update) {
            header("Location: transaksi.php?pesan=update_sukses");
            exit();
        } else {
            echo "Gagal update: " . mysqli_error($conn);
        }
    } else {
        echo "Barang tidak ditemukan!";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Transaksi</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
    .nav-link { color: white !important; }
    .nav-link.active { font-weight: bold; }
  </style>  
</head>
<body>
    <nav class="nav justify-content-center bg-dark">
      <a class="nav-link active" href="index.php">Home</a>
      <a class="nav-link active" href="tambahb.php">Tambah</a>
      <a class="nav-link active" href="transaksi.php">Transaksi</a>
      <a class="nav-link active" href="logout.php" onclick="confirmLogout(event)">Log Out</a>
    </nav>
<div class="container mt-4">
  <h2>Edit Transaksi</h2>
  <form method="POST">
    <div class="mb-3">
      <label for="kode_brg" class="form-label">Barang</label>
      <select name="kode_brg" id="kode_brg" class="form-control" required>
        <?php while ($row = mysqli_fetch_assoc($barang)) { ?>
          <option value="<?= $row['kode_brg'] ?>" 
            <?= $row['kode_brg'] == $transaksi['kode_brg'] ? 'selected' : '' ?>>
            <?= $row['nama_brg'] ?> (Rp <?= number_format($row['harga'], 0, ',', '.') ?>)
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="jumlah" class="form-label">Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" value="<?= $transaksi['jumlah'] ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Bayar</label>
      <input type="text" value="Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?>" class="form-control" readonly>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="transaksi.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
