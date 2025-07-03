<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    header('Location: ../login.php');
    exit();
}

// Cek apakah request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>
        alert('Akses tidak valid.');
        window.history.back();
    </script>";
    exit();
}

// Ambil dan validasi ID
$id_buku = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id_buku <= 0) {
    echo "<script>
        alert('ID Buku tidak valid.');
        window.history.back();
    </script>";
    exit();
}

require_once __DIR__ . '/../../core/autoload.php';

// Hapus buku dari database
$stmt = $connect->prepare('DELETE FROM buku WHERE id = ?');
$stmt->bind_param('i', $id_buku);

if ($stmt->execute()) {
    echo "<script>
        alert('Buku berhasil dihapus.');
        window.location.href = '../../katalog.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus buku.');
        window.history.back();
    </script>";
}
exit();
