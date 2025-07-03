<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    header('Location: ../login.php');
    exit();
}

// Validasi ID buku
if (!isset($_POST['id']) || !is_numeric($_POST['id']) || intval($_POST['id']) <= 0) {
    die('ID Buku tidak valid.');
}

$id_buku = intval($_POST['id']);

require_once __DIR__ . '/../../core/autoload.php';

// Ambil data buku
$stmt = $connect->prepare('SELECT * FROM buku WHERE id = ?');
$stmt->bind_param('i', $id_buku);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('Buku tidak ditemukan.');
}

$buku = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Edit Buku | <?= htmlspecialchars($buku['judul']) ?></title>
    <link rel="stylesheet" href="../../css/edit.css" />
</head>

<body>

    <div class="container">
        <h2>Edit Buku</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($buku['id']) ?>" />
            <input type="hidden" name="redirect_url" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER']) ?>">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required />
            </div>

            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']) ?>" required />
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun" value="<?= htmlspecialchars($buku['tahun']) ?>" required />
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" value="<?= htmlspecialchars($buku['penerbit']) ?>" required />
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" value="<?= htmlspecialchars($buku['kategori']) ?>" />
            </div>

            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis"><?= htmlspecialchars($buku['sinopsis']) ?></textarea>
            </div>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

</body>

</html>
