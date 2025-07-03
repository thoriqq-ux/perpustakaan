<?php
session_start();

// Cek apakah admin login
if (!isset($_SESSION['login_admin'])) {
    echo "<script>
        alert('Anda harus login sebagai admin.');
        window.location.href = '../../faq.php';
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

$pertanyaan = isset($_POST['pertanyaan']) ? trim($_POST['pertanyaan']) : '';
$jawaban = isset($_POST['jawaban']) ? trim($_POST['jawaban']) : '';

// Validasi input
if (empty($pertanyaan) || empty($jawaban)) {
    echo "<script>
        alert('Pertanyaan dan Jawaban wajib diisi.');
        window.history.back();
    </script>";
    exit();
}

// ✅ Perbaikan path autoload.php
require_once dirname(dirname(__DIR__)) . '/core/autoload.php';

// Simpan ke database
$stmt = $connect->prepare('INSERT INTO faq (pertanyaan, jawaban) VALUES (?, ?)');
$stmt->bind_param('ss', $pertanyaan, $jawaban);

if ($stmt->execute()) {
    echo "<script>
        alert('FAQ berhasil ditambahkan.');
        window.location.href = '../../faq.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menyimpan FAQ.');
        window.history.back();
    </script>";
}
exit();
