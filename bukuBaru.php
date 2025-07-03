<?php
require_once __DIR__ . '/core/autoload.php';

// Query untuk ambil buku baru (misalnya berdasarkan tahun terbit terbaru)
$query = 'SELECT * FROM buku ORDER BY tahun DESC LIMIT 8';
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buku Baru | Perpustakaan Digital</title>
    <link rel="stylesheet" href="css/bukuBaru.css" />
</head>

<body>

    <!-- Header -->
    <header class="page-header">
        <h1>Rekomendasi Buku Baru</h1>
        <p>Temukan koleksi buku terbaru dari berbagai genre.</p>
        <a href="index.php" class="btn-back">← Kembali</a>
    </header>

    <!-- Cards Container -->
    <section class="cards-container" id="bookResults">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <a href="detailBuku.php?id=<?= $row['id'] ?>" class="book-card-link">
                    <div class="book-card">
                        <h3><?= htmlspecialchars($row['judul']) ?></h3>
                        <p><strong>Pengarang:</strong> <?= htmlspecialchars($row['pengarang']) ?></p>
                        <p><strong>Kategori:</strong><?= $row['kategori'] ? htmlspecialchars($row['kategori']) : 'Tidak ada' ?>
                        </p>
                        <p><strong>Tahun:</strong> <?= htmlspecialchars($row['tahun']) ?></p>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-result">Belum ada buku baru saat ini.</p>
        <?php endif; ?>
    </section>

</body>

</html>