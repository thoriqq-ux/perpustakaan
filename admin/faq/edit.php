<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    header('Location: ../login.php');
    exit();
}

// Cek apakah ID tersedia dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID FAQ tidak valid.');
}

$id = intval($_GET['id']);

require_once dirname(dirname(__DIR__)) . '/core/autoload.php';

// Ambil data FAQ dari database
$stmt = $connect->prepare('SELECT * FROM faq WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('FAQ tidak ditemukan.');
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Edit FAQ</title>
    <link rel="stylesheet" href="../../css/editFaq.css" />
</head>

<body>

    <div class="container">
        <h2>Edit Pertanyaan & Jawaban</h2>
        <form action="update.php" method="post">
            <!-- Hidden ID -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />

            <!-- Pertanyaan -->
            <div class="form-group">
                <label>Pertanyaan</label>
                <input type="text" name="pertanyaan" value="<?= htmlspecialchars($row['pertanyaan']) ?>" required />
            </div>

            <!-- Jawaban -->
            <div class="form-group">
                <label>Jawaban</label>
                <textarea name="jawaban" rows="6" required><?= htmlspecialchars($row['jawaban']) ?></textarea>
            </div>

            <!-- Tombol Submit -->
            <button type="submit">Update FAQ</button>
        </form>

        <!-- Link Kembali -->
        <div class="back-link">
            <a href="../../faq.php">← Kembali ke FAQ</a>
        </div>
    </div>

</body>

</html>