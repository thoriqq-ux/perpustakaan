<?php
session_start();
require_once __DIR__ . '/core/autoload.php';

// Cek login
if (!isset($_SESSION['login_member'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: member/login.php');
    exit();
}

// Ambil ID buku
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
        alert('ID Buku tidak valid.');
        window.history.back();
    </script>";
    exit();
}

$id_buku = intval($_GET['id']);
$id_anggota = $_SESSION['id_anggota'];

// Simpan data peminjaman
$tanggal_pinjam = date('Y-m-d');

$stmt = $connect->prepare('INSERT INTO pinjam (id_anggota, id_buku, tanggal_pinjam) VALUES (?, ?, ?)');
$stmt->bind_param('iis', $id_anggota, $id_buku, $tanggal_pinjam);

if ($stmt->execute()) {
    echo "<script>
        alert('Berhasil meminjam buku.');
        window.history.back();
    </script>";
} else {
    echo "<script>
        alert('Gagal meminjam buku.');
        window.history.back();
    </script>";
}
exit();
