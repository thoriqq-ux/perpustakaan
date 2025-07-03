<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    echo "<script>
            alert('Anda harus login sebagai admin.');
            window.location.href = '../login.php';
          </script>";
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

// Ambil dan sanitasi input
$judul = trim($_POST['judul']);
$pengarang = trim($_POST['pengarang']);
$tahun = trim($_POST['tahun']);
$penerbit = trim($_POST['penerbit']);
$kategori = trim($_POST['kategori']);
$sinopsis = trim($_POST['sinopsis']);

// Validasi input wajib
if (empty($judul) || empty($pengarang) || empty($tahun) || empty($penerbit)) {
    echo "<script>
            alert('Judul, Pengarang, Tahun, dan Penerbit wajib diisi.');
            window.history.back();
          </script>";
    exit();
}

require_once __DIR__ . '/../../core/autoload.php';

try {
    // Simpan ke database
    $stmt = $connect->prepare("INSERT INTO buku (judul, pengarang, tahun, penerbit, kategori, sinopsis) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $judul, $pengarang, $tahun, $penerbit, $kategori, $sinopsis);

    if ($stmt->execute()) {
        echo "<script>
                alert('Buku berhasil ditambahkan.');
                window.location.href = '../../katalog.php';
              </script>";
    } else {
        throw new Exception('Gagal menyimpan buku.');
    }
} catch (Exception $e) {
    echo "<script>
            alert('Error: " . addslashes($e->getMessage()) . "');
            window.history.back();
          </script>";
    exit();
}
