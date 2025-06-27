<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['login_member'])) {
  header('Location: ../member/login.php');
  exit();
}

if (!isset($_GET['id'])) {
  header('Location: ./index.php');
  exit();
}

$id_buku = intval($_GET['id']);

require_once __DIR__ . '/../core/autoload.php';

$query = "SELECT * FROM buku WHERE id = $id_buku";
$result = mysqli_query($connect, $query);

// Jika tidak ada data
if ($result->num_rows == 0) {
  header('Location: ./index.php');
  exit();
}

$data = mysqli_fetch_assoc($result);

if (isset($_GET['confirm'])) {
  if ($_GET['confirm'] === 'yes') {
    if (!isset($_SESSION['login_member'])) {
      header('Location: ../member/login.php');
      exit();
    }

    $id_anggota = $_SESSION['id_anggota'];
	$tanggal_pinjam = date('Y-m-d');
	$tanggal_kembali = date('Y-m-d', strtotime('+7 days'));

    $query = 'INSERT INTO pinjam (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 'iiss', $id_anggota, $id_buku, $tanggal_pinjam, $tanggal_kembali);

    if (mysqli_stmt_execute($stmt)) {
      header('Location: ./index.php');
      exit();
    } else {
      die('Terjadi kesalahan saat meminjam buku: ' . mysqli_error($connect));
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Konfirmasi Pinjam | Perpustakaan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/pinjam.css">
</head>

<body>

  <div class="container">
    <h1>Konfirmasi Pinjam Buku</h1>

    <p>Pastikan data di bawah ini benar sebelum Anda meminjam:</p>

    <table>
      <tr>
        <th>Judul buku</th>
        <td><?= htmlspecialchars($data['judul']) ?></td>
      </tr>
      <tr>
        <th>Pengarang</th>
        <td><?= htmlspecialchars($data['pengarang']) ?></td>
      </tr>
      <tr>
        <th>Tahun terbit</th>
        <td><?= htmlspecialchars($data['tahun']) ?></td>
      </tr>
      <tr>
        <th>Penerbit</th>
        <td><?= htmlspecialchars($data['penerbit']) ?></td>
      </tr>
      <tr>
        <th>Kategori</th>
        <td><?= $data['kategori'] ? htmlspecialchars($data['kategori']) : 'Tidak ada' ?></td>
      </tr>
    </table>

    <div class="actions">
      <a href="<?= './pinjam.php?id=' . $data['id'] . '&confirm=yes' ?>">Lanjutkan</a>
      <a href="javascript:window.history.back();">Batalkan</a>
    </div>
  </div>

</body>

</html>