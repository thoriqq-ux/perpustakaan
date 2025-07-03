<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    header('Location: ../faq.php');
    exit();
}

// Cek apakah ID tersedia dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
        alert('ID FAQ tidak valid.');
        window.history.back();
    </script>";
    exit();
}

$id = intval($_GET['id']);

require_once dirname(dirname(__DIR__)) . '/core/autoload.php';

// Hapus data dari database
$stmt = $connect->prepare('DELETE FROM faq WHERE id = ?');
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo "<script>
        alert('FAQ berhasil dihapus.');
        window.location.href = '../../faq.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus FAQ.');
        window.history.back();
    </script>";
}
exit();
