<?php
session_start();

$error = '';

// Jika form disubmit
if (isset($_POST['login-admin']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi';
    } else {
        require_once __DIR__ . '/../core/autoload.php';

        // Query ke tabel admin
        $query = 'SELECT * FROM admin WHERE username = ?';
        $stmt = mysqli_prepare($connect, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 0) {
                $error = 'Username atau password salah';
            } else {
                $row = mysqli_fetch_assoc($result);

                if (!password_verify($password, $row['password'])) {
                    $error = 'Username atau password salah';
                } else {
                    // Set session admin
                    $_SESSION['login_admin'] = true;
                    $_SESSION['admin_id'] = (int) $row['id'];
                    $_SESSION['admin_username'] = $row['username'];
                    $_SESSION['admin_nama'] = $row['nama'];
                    $_SESSION['alamat'] = $row['alamat']; // jika diperlukan

                    // Regenerasi ID sesi untuk keamanan
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

// Jika sudah login sebagai admin, redirect ke dashboard atau index
if (isset($_SESSION['login_admin']) && $_SESSION['login_admin'] === true) {
    header('Location: dashboard.php'); // Ganti dengan halaman admin utama
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin | Perpustakaan Digital</title>
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>

    <div class="login-container">
        <h2>Perpustakaan Digital</h2>
        <h3>Login Admin</h3>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <p class="error"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

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

            <button type="submit" name="login-admin">Masuk</button>
        </form>

        <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>

</body>

</html>