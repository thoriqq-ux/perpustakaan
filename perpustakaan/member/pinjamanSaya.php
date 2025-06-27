<?php
session_start();
require_once __DIR__ . '/../core/autoload.php';

// Cek login
if (!isset($_SESSION['login_member'])) {
  header("Location: ../member/login.php");
  exit;
}

$id_anggota = $_SESSION['id_anggota'];

// Ambil data pinjaman aktif user
$query = "
  SELECT p.*, b.judul 
  FROM pinjam p 
  JOIN buku b ON p.id_buku = b.id 
  WHERE p.id_anggota = '$id_anggota' AND p.status = 'dipinjam'
  ORDER BY p.tanggal_pinjam DESC
";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pinjaman Saya</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1>Daftar Buku yang Sedang Dipinjam</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
			<th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= htmlspecialchars($row['judul']) ?></td>
              <td><?= $row['tanggal_pinjam'] ?></td>
              <td><?= $row['tanggal_kembali'] ?></td>
			  <td>
        <a href="kembalikan.php?id=<?= $row['id'] ?>" class="btn-kembalikan"
           onclick="return confirm('Yakin ingin mengembalikan buku ini?');">
           Kembalikan
		    </a>
			</td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Kamu belum meminjam buku apa pun.</p>
    <?php endif; ?>
  </div>
</body>
</html>
