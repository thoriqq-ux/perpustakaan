<?php
require_once __DIR__ . '/core/autoload.php';

// Ambil parameter pencarian
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

$where = [];

if (!empty($search)) {
    $safe_search = mysqli_real_escape_string($connect, $search);
    $where[] = "(judul LIKE '%$safe_search%' OR pengarang LIKE '%$safe_search%')";
}

if (!empty($kategori)) {
    $safe_kategori = mysqli_real_escape_string($connect, $kategori);
    $where[] = "kategori = '$safe_kategori'";
}

$where_sql = !empty($where) ? ' WHERE ' . implode(' AND ', $where) : '';

// Query untuk ambil data buku
$query = "SELECT * FROM buku $where_sql";
$result = mysqli_query($connect, $query);

$books = [];

while ($row = mysqli_fetch_assoc($result)) {
    $books[] = [
        'id' => (int) $row['id'],
        'judul' => htmlspecialchars($row['judul']),
        'pengarang' => htmlspecialchars($row['pengarang']),
        'tahun' => htmlspecialchars($row['tahun']),
        'penerbit' => htmlspecialchars($row['penerbit']),
        'kategori' => $row['kategori'] ? htmlspecialchars($row['kategori']) : null,
    ];
}

// Kembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($books);
exit();
