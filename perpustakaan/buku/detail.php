<?php
// Jika tidak diakses lewat link URL yang memiliki id
if (!isset($_GET['id'])) {
    header('Location: ./index.php');
    exit();
}

require_once __DIR__ . '/../core/autoload.php';

$id = intval($_GET['id']); // Pastikan ID aman

$query = "SELECT * FROM buku WHERE id = $id";
$result = mysqli_query($connect, $query);

// Jika tidak ada data
if ($result->num_rows == 0) {
    header('Location: ./index.php');
    exit();
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= htmlspecialchars($data['judul']) ?> | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/detail.css">
</head>

<body>

    <div class="container">
        <h1>Detail Buku</h1>
        <p>Berikut adalah detail buku yang Anda inginkan</p>

        <h3><?= htmlspecialchars($data['judul']) ?></h3>

        <table cellpadding="5">
            <tr>
                <th data-label="Pengarang">Pengarang</th>
                <td data-label="<?= htmlspecialchars($data['pengarang']) ?>">
                    <?= htmlspecialchars($data['pengarang']) ?>
                </td>
            </tr>
            <tr>
                <th data-label="Tahun Terbit">Tahun terbit</th>
                <td data-label="<?= htmlspecialchars($data['tahun']) ?>">
                    <?= htmlspecialchars($data['tahun']) ?>
                </td>
            </tr>
            <tr>
                <th data-label="Penerbit">Penerbit</th>
                <td data-label="<?= htmlspecialchars($data['penerbit']) ?>">
                    <?= htmlspecialchars($data['penerbit']) ?>
                </td>
            </tr>
            <tr>
                <th data-label="Kategori">Kategori</th>
                <td data-label="<?= $data['kategori'] ? htmlspecialchars($data['kategori']) : 'Tidak ada' ?>">
                    <?= $data['kategori'] ? htmlspecialchars($data['kategori']) : 'Tidak ada' ?>
                </td>
            </tr>
        </table>

        <div class="actions">
            <a href="<?= './pinjam.php?id=' . $data['id'] ?>">Pinjam Buku</a>
        </div>
    </div>

</body>

</html>
