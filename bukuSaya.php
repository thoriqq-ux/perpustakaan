<?php
session_start();
require_once __DIR__ . '/core/autoload.php';

// Cek login
if (!isset($_SESSION['login_member'])) {
    header('Location: member/login.php');
    exit();
}

$id_anggota = $_SESSION['id_anggota'];

// Ambil data pinjaman aktif user
$query = "
    SELECT p.*, b.judul 
    FROM pinjam p 
    JOIN buku b ON p.id_buku = b.id 
    WHERE p.id_anggota = '$id_anggota' AND p.status = 'dipinjam'
    ORDER BY p.tanggal_pinjam DESC
";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buku Saya | Perpustakaan Digital</title>
    <link rel="stylesheet" href="css/bukuSaya.css">
</head>

<body>

    <div class="container">
        <h1>Buku yang Sedang Dipinjam</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="cards-container">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
            $tanggal_pinjam = date('Y-m-d', strtotime($row['tanggal_pinjam']));
            $tanggal_kembali = date('Y-m-d', strtotime($row['tanggal_pinjam'] . ' +7 days'));
            ?>
            <div class="card">
                <h3><?= htmlspecialchars($row['judul']) ?></h3>
                <p><strong>Tanggal Pinjam:</strong> <?= $tanggal_pinjam ?></p>
                <p><strong>Harus Dikembalikan Sebelum:</strong> <?= $tanggal_kembali ?></p>
                <a href="kembalikan.php?id=<?= $row['id'] ?>" class="btn-kembalikan"
                    onclick="return confirm('Yakin ingin mengembalikan buku ini?');">
                    Kembalikan Buku
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <p>Kamu belum meminjam buku apa pun.</p>
        <?php endif; ?>

        <div class="back-button">
            <a href="javascript:history.back()" class="btn-back">← Kembali</a>
        </div>
    </div>

</body>

</html>
