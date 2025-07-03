<?php
session_start();
require_once __DIR__ . '/core/autoload.php';

// Cek login
if (!isset($_SESSION['login_member'])) {
    header('Location: member/login.php');
    exit();
}

// Cek apakah ID peminjaman tersedia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID Peminjaman tidak valid.');
}

$id_pinjam = intval($_GET['id']);
$tanggal_kembali = date('Y-m-d'); // Tanggal hari ini

// Update status dan tambahkan tanggal kembali
$stmt = $connect->prepare("UPDATE pinjam SET status = 'dikembalikan', tanggal_kembali = ? WHERE id = ?");
$stmt->bind_param('si', $tanggal_kembali, $id_pinjam);

if ($stmt->execute()) {
    echo "<script>
        alert('Buku berhasil dikembalikan.');
        window.location.href = 'bukuSaya.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal mengembalikan buku.');
        window.history.back();
    </script>";
}
exit();
