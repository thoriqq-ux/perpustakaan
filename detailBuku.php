<?php
session_start();
require_once __DIR__ . '/core/autoload.php';

// Cek apakah user sudah login
if (!isset($_SESSION['login_member']) && !isset($_SESSION['login_admin'])) {
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
                    <?= $buku['kategori'] ? htmlspecialchars($buku['kategori']) : 'Tidak ada' ?></p>
                <div class="sinopsis">
                    <h3>Sinopsis</h3>
                    <p><?= htmlspecialchars($buku['sinopsis'] ?? 'Sinopsis belum tersedia.') ?></p>
                </div>
            </div>
        </section>

        <div class="action-buttons">
            <!-- Jika yang login adalah Member -->
            <?php if (isset($_SESSION['login_member']) && !isset($_SESSION['login_admin'])): ?>
                <a href="pinjam.php?id=<?= $buku['id'] ?>"
                    style="display: inline-block; padding: 0.8rem 1.5rem; background-color: #00796b; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-right: 1rem; transition: background-color 0.3s ease;">
                    Pinjam Buku
                </a>

                <!-- Jika yang login adalah Admin -->
            <?php elseif (isset($_SESSION['login_admin'])): ?>
                <form action="admin/buku/edit.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                    <button type="submit"
                        style="display: inline-block; padding: 0.8rem 1.5rem; background-color: #fbc02d; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-right: 1rem; transition: background-color 0.3s ease; cursor: pointer;">
                        Edit Buku
                    </button>
                </form>

                <form action="admin/buku/hapus.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                    <button type="submit"
                        style="display: inline-block; padding: 0.8rem 1.5rem; background-color: #e53935; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-left: 0.5rem; transition: background-color 0.3s ease; cursor: pointer;"
                        onclick="return confirm('Yakin ingin menghapus buku ini?')">
                        Hapus Buku
                    </button>
                </form>
            <?php endif; ?>
        </div>

    </div>

</body>

</html>