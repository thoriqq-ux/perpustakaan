<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Buku | Perpustakaan Digital</title>
    <link rel="stylesheet" href="../../css/tambah.css" />
</head>

<body>

    <div class="container">
        <h2>Tambah Buku Baru</h2>

        <!-- Form Tambah Buku -->
        <form action="simpan.php" method="post">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" placeholder="Masukkan judul buku" required />
            </div>

            <div class="form-group">
                <label>Nama Pengarang</label>
                <input type="text" name="pengarang" placeholder="Masukkan nama pengarang" required />
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun" placeholder="Masukkan tahun terbit" required />
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" placeholder="Masukkan nama penerbit" required />
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" placeholder="Fiksi, Novel, Sejarah, dll." />
            </div>

            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis" rows="5" placeholder="Masukkan sinopsis buku..."></textarea>
            </div>

            <button type="submit">Simpan Buku</button>
        </form>

        <div class="back-link">
            <a href="../../katalog.php">← Kembali ke Katalog</a>
        </div>
    </div>

</body>

</html>