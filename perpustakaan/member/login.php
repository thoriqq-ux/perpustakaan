<?php
session_start();

// jika sudah login
if (isset($_SESSION['login_member'])) {
  header('Location: ../buku/index.php');
}

$error = '';

// jika klik tombol login
if (isset($_POST['login-member']) && isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  require_once __DIR__ . '/../core/autoload.php';

  $query = "SELECT * FROM anggota WHERE username = '" . $username . "'";
  $result = mysqli_query($connect, $query);

  // Cek apakah username terdaftar
  if ($result->num_rows == 0) {
    $error = 'Username atau password salah';
  } else {
    $row = mysqli_fetch_assoc($result);

    // cek apakah password input sama dengan password di database
    if (!password_verify($password, $row['password'])) {
      $error = 'Username atau password salah';
    } else {
      $_SESSION['login_member'] = true;
      $_SESSION['id_anggota'] = (int) $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['status'] = (int) $row['status'];
      $_SESSION['alamat'] = $row['alamat'];

      header('Location: ../buku/index.php');
      exit();
    }
  }
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
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php } ?>

    <form action="" method="post">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Masukkan username" autofocus required />
      </div>

      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required />
      </div>

      <button type="submit" name="login-member">Masuk</button>
    </form>
    <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
  </div>

</body>

</html>