<?php
require_once __DIR__ . '/core/autoload.php';

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

$where = [];
if ($search !== '') {
    $safe = mysqli_real_escape_string($connect, $search);
    $where[] = "(judul LIKE '%$safe%' OR pengarang LIKE '%$safe%')";
}
if ($kategori !== '') {
    $safeKategori = mysqli_real_escape_string($connect, $kategori);
    $where[] = "kategori = '$safeKategori'";
}

$where_sql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';
$query = "SELECT * FROM buku $where_sql";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku | Perpustakaan</title>
    <link rel="stylesheet" href="../css/buku.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container" style="max-width: 1000px; margin: 40px auto; padding: 2rem; background-color: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
        <h1>Katalog Buku Perpustakaan</h1>
        <p>Lihat dan cari buku-buku yang tersedia. Login diperlukan untuk meminjam.</p>

<form method="get" class="search-bar" style="margin-bottom: 2rem; display: flex; flex-wrap: wrap; gap: 1rem;">
  <input
    type="text"
    name="q"
    placeholder="Cari judul atau pengarang..."
    value="<?= htmlspecialchars($search) ?>"
    style="flex: 1; min-width: 200px; padding: 0.6rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;"
  >

  <select
    name="kategori"
    style="padding: 0.6rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem;"
  >
    <option value="">Semua Kategori</option>
    <option value="Fiksi" <?= $kategori == 'Fiksi' ? 'selected' : '' ?>>Fiksi</option>
    <option value="Novel" <?= $kategori == 'Novel' ? 'selected' : '' ?>>Novel</option>
    <option value="Sejarah" <?= $kategori == 'Sejarah' ? 'selected' : '' ?>>Sejarah</option>
    <option value="Motivasi" <?= $kategori == 'Motivasi' ? 'selected' : '' ?>>Motivasi</option>
    <option value="Romansa" <?= $kategori == 'Romansa' ? 'selected' : '' ?>>Romansa</option>
  </select>

  <button type="submit" class="btn btn-primary">Cari</button>
</form>


        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= htmlspecialchars($row['pengarang']) ?></td>
                            <td><?= htmlspecialchars($row['tahun']) ?></td>
                            <td><?= htmlspecialchars($row['penerbit']) ?></td>
                            <td><?= $row['kategori'] ? htmlspecialchars($row['kategori']) : 'Tidak ada' ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Tidak ada buku ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="member/login.php" class="btn btn-primary">Login untuk Meminjam Buku</a>
        </div>
    </div>
</body>

</html>
