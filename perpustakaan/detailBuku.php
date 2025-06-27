<?php
session_start();
require_once __DIR__ . '../core/autoload.php';

// Cek apakah user sudah login
if (!isset($_SESSION['login_member'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: member/login.php');
    exit();
}

// Cek apakah ID buku tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID Buku tidak valid.');
}

$id_buku = intval($_GET['id']);

// Ambil data buku dari database
$query = "SELECT * FROM buku WHERE id = $id_buku";
$result = mysqli_query($connect, $query);

// Cek apakah buku ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    die('Buku tidak ditemukan.');
}

$buku = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Buku | <?= htmlspecialchars($buku['judul']) ?></title>
    <link rel="stylesheet" href="css/detailBuku.css" />
</head>

<body>

    <div class="container">
        <header class="page-header">
            <h1>Detail Buku</h1>
            <p>Berikut adalah informasi lengkap tentang buku ini.</p>
            <a href="javascript:history.back()" class="btn-back">← Kembali</a>
        </header>

        <section class="book-detail">
            <div class="book-info">
                <h2><?= htmlspecialchars($buku['judul']) ?></h2>
                <p><strong>Pengarang:</strong> <?= htmlspecialchars($buku['pengarang']) ?></p>
                <p><strong>Tahun Terbit:</strong> <?= htmlspecialchars($buku['tahun']) ?></p>
                <p><strong>Penerbit:</strong> <?= htmlspecialchars($buku['penerbit']) ?></p>
                <p><strong>Kategori:</strong>
                    <?= $buku['kategori'] ? htmlspecialchars($buku['kategori']) : 'Tidak ada' ?>
                </p>
            </div>
        </section>

        <div class="action-buttons">
            <?php if (isset($_SESSION['login_member'])): ?>
                <a href="buku/pinjam.php?id=<?= $buku['id'] ?>" class="btn-pinjam">Pinjam Buku</a>
            <?php else: ?>
                <a href="../member/login.php" class="btn-pinjam">Pinjam Sekarang</a>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>