<?php
session_start();
require_once __DIR__ . '/../core/autoload.php';

// Cek login
if (!isset($_SESSION['login_member'])) {
  header("Location: ../member/login.php");
  exit;
}

// Cek apakah ID pinjam tersedia
if (!isset($_GET['id'])) {
  header("Location: pinjamanSaya.php");
  exit;
}

$id_pinjam = intval($_GET['id']);
$id_anggota = $_SESSION['id_anggota'];

// Update status jadi "dikembalikan"
$query = "UPDATE pinjam SET status = 'dikembalikan' WHERE id = ? AND id_anggota = ?";
$stmt = mysqli_prepare($connect, $query);

if (!$stmt) {
  die('Prepare failed: ' . mysqli_error($connect));
}

mysqli_stmt_bind_param($stmt, 'ii', $id_pinjam, $id_anggota);

if (mysqli_stmt_execute($stmt)) {
  // Sukses update
  header('Location: pinjamanSaya.php');
  exit;
} else {
  // Gagal update, tampilkan pesan
  die('Gagal mengupdate status: ' . mysqli_error($connect));
}

// Pastikan pinjaman ini milik user yang login dan statusnya "dipinjam"
$cek = mysqli_query($connect, "SELECT * FROM pinjam WHERE id = $id_pinjam AND id_anggota = $id_anggota AND status = 'dipinjam'");
if (mysqli_num_rows($cek) == 0) {
  header("Location: pinjamanSaya.php");
  exit;
}

// Proses pengembalian: update status ke "dikembalikan"
$update = mysqli_query($connect, "UPDATE pinjam SET status = 'dikembalikan', tanggal_kembali = NOW() WHERE id = $id_pinjam");

if ($update) {
  header("Location: pinjamanSaya.php");
  exit;
} else {
  echo "Gagal mengembalikan buku. Error: " . mysqli_error($connect);
}
?>
