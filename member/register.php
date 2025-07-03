<?php
session_start();

// Jika sudah login, arahkan ke halaman buku
if (isset($_SESSION['login_member'])) {
    header('Location: ../buku/index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);

    // Validasi input
    if (empty($username) || empty($password) || empty($nama) || empty($alamat)) {
        $error = 'Semua field harus diisi.';
    } else {
        require_once __DIR__ . '/../core/autoload.php';

        // Cek apakah username sudah ada
        $stmt = $connect->prepare('SELECT * FROM anggota WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Username sudah terdaftar.';
        } else {
            // Enkripsi password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan ke database
            $stmt = $connect->prepare('INSERT INTO anggota (username, password, nama, alamat, status) VALUES (?, ?, ?, ?, 1)');
            $stmt->bind_param('ssss', $username, $hashed_password, $nama, $alamat);

            if ($stmt->execute()) {
                $_SESSION['login_member'] = true;
                $_SESSION['id_anggota'] = $connect->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['nama'] = $nama;
                $_SESSION['status'] = 1;
                $_SESSION['alamat'] = $alamat;

                header('Location: ../buku/index.php');
                exit();
            } else {
                $error = 'Terjadi kesalahan saat mendaftar.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Member Baru</title>
    <link rel="stylesheet" href="../css/register.css" />
</head>

<body>

    <div class="register-container">
        <h2>Perpustakaan Digital</h2>
        <h3>Daftar Anggota Baru</h3>

        <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required
                    autofocus />
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required />
            </div>

            <div class="input-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required />
            </div>

            <div class="input-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>

            <button type="submit">Daftar</button>

            <p class="login-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>

</body>

</html>
