<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Buku | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/buku.css">
</head>

<body>

    <?php
    session_start();

    // Cek apakah user sudah login
    if (!isset($_SESSION['login_member'])) {
        header('Location: ../member/login.php');
        exit();
    }
    ?>

    <div class="container">
        <h1>Daftar Buku Perpustakaan</h1>
        <p>Silakan pilih buku untuk dipinjam.</p>

        <div class="logout-button">
            <a href="../member/logout.php">Logout</a>
        </div>

        <?php
        require_once __DIR__ . '/../core/autoload.php';

        $query = 'SELECT * FROM buku';
        $result = mysqli_query($connect, $query);

        if (!$result) {
            die('Query gagal: ' . mysqli_error($connect));
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><a href="<?= './detail.php?id=' . $row['id'] ?>"><?= htmlspecialchars($row['judul']) ?></a></td>
                        <td><?= htmlspecialchars($row['pengarang']) ?></td>
                        <td><?= htmlspecialchars($row['tahun']) ?></td>
                        <td><?= htmlspecialchars($row['penerbit']) ?></td>
                        <td><?= $row['kategori'] ? htmlspecialchars($row['kategori']) : 'Tidak ada' ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>