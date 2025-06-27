<?php
session_start();

$error = '';

// Proses login
if (isset($_POST['login-member']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input tidak kosong
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi';
    } else {
        require_once __DIR__ . '/../core/autoload.php';

        $query = 'SELECT * FROM anggota WHERE username = ?';
        $stmt = mysqli_prepare($connect, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Cek apakah username terdaftar
            if (mysqli_num_rows($result) == 0) {
                $error = 'Username atau password salah';
            } else {
                $row = mysqli_fetch_assoc($result);

                if (!password_verify($password, $row['password'])) {
                    $error = 'Username atau password salah';
                } else {
                    $_SESSION['login_member'] = true;
                    $_SESSION['id_anggota'] = (int) $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['status'] = (int) $row['status'];
                    $_SESSION['alamat'] = $row['alamat'];

                    // Regenerate session ID untuk keamanan
                    session_regenerate_id(true);

                    // Redirect setelah login
                    if (isset($_SESSION['redirect_after_login'])) {
                        $redirect = $_SESSION['redirect_after_login'];
                        unset($_SESSION['redirect_after_login']);
                        header("Location: $redirect");
                        exit();
                    } else {
                        header('Location: ../index.php');
                        exit();
                    }
                }
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = 'Terjadi kesalahan sistem';
        }
    }
}

// Jika sudah login, redirect ke halaman utama
if (isset($_SESSION['login_member']) && $_SESSION['login_member'] === true) {
    header('Location: ../buku/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Member</title>
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>

    <div class="login-container">
        <h2>Perpustakaan Online</h2>
        <h3>Login Member</h3>

        <?php if (!empty($error)) { ?>
        <div class="error-message">
            <p class="error"><?= htmlspecialchars($error) ?></p>
        </div>
        <?php } ?>

        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username"
                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" autofocus
                    required />
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required />
            </div>

            <button type="submit" name="login-member">Masuk</button>
        </form>
        <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>

</body>

</html>
