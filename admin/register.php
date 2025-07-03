<?php session_start(); ?>

<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);

    if (empty($username) || empty($password) || empty($nama) || empty($alamat)) {
        $error = 'Semua field harus diisi.';
    } else {
        require_once __DIR__ . '/../core/autoload.php';

        // Cek apakah username sudah ada
        $stmt = $connect->prepare('SELECT * FROM admin WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Username sudah terdaftar.';
        } else {
            // Enkripsi password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan ke tabel admin
            $stmt = $connect->prepare('INSERT INTO admin (username, password, nama, alamat) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $username, $hashed_password, $nama, $alamat);

            if ($stmt->execute()) {
                // Login otomatis setelah daftar
                $_SESSION['login_admin'] = true;
                $_SESSION['admin_id'] = $connect->insert_id;
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_nama'] = $nama;

                header('Location: ../index.php');
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
    <title>Daftar Admin | Perpustakaan Digital</title>
    <link rel="stylesheet" href="../css/register.css" />
</head>

<body>

    <div class="register-container">
        <h2>Perpustakaan Digital</h2>
        <h3>Daftar Admin Baru</h3>

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