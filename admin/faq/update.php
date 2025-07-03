<?php
session_start();

if (!isset($_SESSION['login_admin'])) {
    echo "<script>
        alert('Akses ditolak.');
        window.location.href = '../faq.php';
    </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../faq.php');
    exit();
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$pertanyaan = trim($_POST['pertanyaan']);
$jawaban = trim($_POST['jawaban']);

if ($id <= 0 || empty($pertanyaan) || empty($jawaban)) {
    echo "<script>
        alert('Data tidak valid.');
        window.history.back();
    </script>";
    exit();
}

require_once dirname(dirname(__DIR__)) . '/core/autoload.php';

// Update data FAQ
$stmt = $connect->prepare('UPDATE faq SET pertanyaan = ?, jawaban = ? WHERE id = ?');
$stmt->bind_param('ssi', $pertanyaan, $jawaban, $id);

if ($stmt->execute()) {
    echo "<script>
        alert('FAQ berhasil diperbarui.');
        window.location.href = '../../faq.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui FAQ.');
        window.history.back();
    </script>";
}
exit();
