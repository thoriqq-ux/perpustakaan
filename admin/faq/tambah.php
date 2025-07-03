<?php
session_start();

if (!isset($_SESSION['login_admin'])) {
    header('Location: ../faq.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah FAQ</title>
    <link rel="stylesheet" href="../../css/tambahFaq.css" />
</head>

<body>

    <div class="container">
        <h2>Tambah FAQ Baru</h2>
        <form action="simpan.php" method="post">
            <div class="form-group">
                <label>Pertanyaan</label>
                <input type="text" name="pertanyaan" required />
            </div>
            <div class="form-group">
                <label>Jawaban</label>
                <textarea name="jawaban" rows="5" required></textarea>
            </div>
            <button type="submit">Simpan FAQ</button>
        </form>
    </div>

</body>

</html>