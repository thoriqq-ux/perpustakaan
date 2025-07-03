<?php
session_start();

// Cek login admin
if (!isset($_SESSION['login_admin'])) {
    header('Location: ../login.php');
    exit();
}

// Cek metode request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>
        alert('Akses tidak valid.');
        window.history.back();
    </script>";
    exit();
}

// Ambil data POST
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$judul = trim($_POST['judul']);
$pengarang = trim($_POST['pengarang']);
$tahun = trim($_POST['tahun']);
$penerbit = trim($_POST['penerbit']);
$kategori = trim($_POST['kategori']);
$sinopsis = trim($_POST['sinopsis']);
$redirect_url = $_POST['redirect_url'];

// Validasi ID
if ($id <= 0) {
    echo "<script>
        alert('ID Buku tidak valid.');
        window.history.back();
    </script>";
    exit();
}

require_once __DIR__ . '/../../core/autoload.php';

// Update data buku
$stmt = $connect->prepare('UPDATE buku SET judul = ?, pengarang = ?, tahun = ?, penerbit = ?, kategori = ?, sinopsis = ? WHERE id = ?');
$stmt->bind_param('ssssssi', $judul, $pengarang, $tahun, $penerbit, $kategori, $sinopsis, $id);

if ($stmt->execute()) {
    echo "<script>
        alert('Data buku berhasil diperbarui.');
        window.location.href = '$redirect_url';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data buku.');
        window.history.back();
    </script>";
}
exit();
