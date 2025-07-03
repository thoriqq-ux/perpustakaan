<?php session_start(); ?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perpustakaan Digital</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/landing.css">
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand"><a href="index.php">📚 Perpustakaan Digital</a></div>
      <ul class="navbar-links">
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="#">Buku</a>
          <ul class="dropdown-content">
            <li><a href="bukuBaru.php">Buku Baru</a></li>
            <li><a href="bukuSaya.php">Buku Saya</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="profil.php">Profil</a>
        </li>
        <li><a href="faq.php">FAQ</a></li>

        <ul class="navbar-links">
          <?php if (!isset($_SESSION['login_member']) && !isset($_SESSION['login_admin'])): ?>
            <li><a href="member/login.php">Login Member</a></li>
            <li><a href="admin/login.php">Login Admin</a></li>
          <?php else: ?>
            <li><a href="logout.php">Logout</a></li>
          <?php endif; ?>
        </ul>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <div class="hero-content">
        <div class="hero-image">
          <img src="img/orang-baca-buku.png" alt="Orang Membaca Buku" />
        </div>
        <div class="hero-text">
          <h1>Selamat Datang di Perpustakaan Digital</h1>
          <p>Platform membaca dan eksplorasi koleksi buku berbasis online. Temukan buku favoritmu dan nikmati
            akses yang mudah ke sumber pengetahuan di mana saja dan kapan saja.</p>
          <div class="cta">
            <a href="katalog.php" class="btn btn-primary">Jelajahi Katalog Buku</a>
          </div>
        </div>
      </div>
    </section>

    <section class="features-section">
      <h2>Keunggulan Perpustakaan Kami</h2>
      <div class="features-cards">
        <div class="feature-card">
          <img src="assets/icons/books.png" alt="Koleksi Buku Lengkap">
          <h3>Koleksi Buku Lengkap</h3>
          <p>Tersedia ribuan judul dari berbagai kategori untuk semua minat dan usia.</p>
        </div>
        <div class="feature-card">
          <img src="assets/icons/check.png" alt="Akses Online 24/7">
          <h3>Akses Online 24/7</h3>
          <p>Nikmati kemudahan mengakses buku kapan saja dan di mana saja secara online.</p>
        </div>
        <div class="feature-card">
          <img src="assets/icons/search.png" alt="Pencarian Cepat">
          <h3>Pencarian Cepat</h3>
          <p>Temukan buku favoritmu dalam hitungan detik dengan fitur pencarian pintar.</p>
        </div>
      </div>
    </section>
</body>

<section class="testimonials" style="background: linear-gradient(to bottom, #e8fdf7, #004d40);">
  <h2>Apa Kata Pengguna?</h2>
  <div class="testimonial-grid">
    <div class="testimonial-item">
      <p>"Sangat membantu! Saya bisa cari buku kuliah kapan pun dibutuhkan."</p>
      <strong>— Rina, Mahasiswa</strong>
    </div>
    <div class="testimonial-item">
      <p>"Tampilan user-friendly dan koleksi bukunya lengkap. Saya suka!"</p>
      <strong>— Budi, Pengguna Umum</strong>
    </div>
    <div class="testimonial-item">
      <p>"Sebagai guru, ini jadi sumber referensi yang praktis untuk siswa-siswa saya."</p>
      <strong>— Ibu Sari, Guru</strong>
    </div>
  </div>
</section>

<section class="publishers-section">
  <h2>Akses Konten dari Penerbit Terbaik</h2>
  <div class="publisher-logos">
    <img src="assets/publishers/GRAMEDIA.jpg" alt="gramedia">
    <img src="assets/publishers/EGC.jpeg" alt="EGC">
    <img src="assets/publishers/ERLANGGA.jpg" alt="erlangga">
  </div>
</section>
</main>

<footer class="site-footer">
  <div class="footer-container">
    <div class="social-links">
      <a href="#" class="social-link">
        <img src="assets/icons/facebook.png" alt="Facebook" />
        Facebook
      </a>
      <a href="#" class="social-link">
        <img src="assets/icons/instagram.png" alt="Instagram" />
        Instagram
      </a>
      <a href="#" class="social-link">
        <img src="assets/icons/youtube.png" alt="YouTube" />
        YouTube
      </a>
    </div>

    <div class="contact-info">
      <h3>Kontak Kami</h3>
      <p>Email: info@perpusdigital.com</p>
      <p>Telepon: +62 812-3456-7890</p>
      <p>Alamat: Jl. Buku Cerita No. 123, Jakarta</p>
    </div>

    <div class="copyright">
      <p>&copy; 2025 Perpustakaan Digital. All rights reserved.</p>
    </div>
  </div>
</footer>
</body>

</html>