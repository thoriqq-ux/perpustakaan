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
      <div class="navbar-brand">📚 Perpustakaan Digital</div>
      <ul class="navbar-links">
        <li class="dropdown">
          <a href="#">Rekomendasi</a>
          <ul class="dropdown-content">
            <li><a href="bukuBaru.php">Buku Baru</a></li>
            <li><a href="buku/index.php">Daftar Buku</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">Profil</a>
          <ul class="dropdown-content">
            <li><a href="#tentang">Tentang Kami</a></li>
            <li><a href="#visi">Visi & Misi</a></li>
            <li><a href="#tim">Tim Kami</a></li>
          </ul>
        </li>
        <li><a href="index.php#faq">FAQ</a></li>
        <ul class="navbar-links">
          <?php if (!isset($_SESSION['login_member']) && !isset($_SESSION['login_admin'])): ?>
            <!-- Jika belum login -->
            <li><a href="member/login.php">Login Member</a></li>
            <li><a href="admin/login.php">Login Admin</a></li>
          <?php else: ?>
            <!-- Jika sudah login -->
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
          <img src="img/orang%20baca%20buku.jpg" alt="Orang Membaca Buku" />
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
 
 <!-- PROFIL: Tentang Kami -->
<section id="tentang" class="info-section">
  <h2>Tentang Kami</h2>
  <p>Perpustakaan Digital adalah platform eksplorasi buku online gratis dan mudah diakses oleh semua kalangan.</p>
</section>

<!-- PROFIL: Visi & Misi -->
<section id="visi" class="info-section">
  <h2>Visi & Misi</h2>
  <p><strong>Visi:</strong> Menjadi pusat literasi digital terbesar.<br>
     <strong>Misi:</strong> Memudahkan akses buku, meningkatkan minat baca, dan memperluas literasi teknologi.</p>
</section>

<!-- PROFIL: Tim Kami -->
<section id="tim" class="info-section">
  <h2>Tim Kami</h2>
  <p>Proyek ini dikembangkan oleh tim mahasiswa yang berkomitmen untuk inovasi literasi dan teknologi.</p>
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

 <section id="faq" class="info-section">
  <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>

  <div class="faq-item">
    <button class="faq-question">Bagaimana cara meminjam buku?</button>
    <div class="faq-answer">
      <p>Login terlebih dahulu, buka detail buku, lalu klik tombol "Pinjam Buku".</p>
    </div>
  </div>

  <div class="faq-item">
    <button class="faq-question">Apakah layanan ini gratis?</button>
    <div class="faq-answer">
      <p>Ya, perpustakaan ini gratis untuk semua pengguna yang terdaftar.</p>
    </div>
  </div>

  <div class="faq-item">
    <button class="faq-question">Berapa lama durasi peminjaman?</button>
    <div class="faq-answer">
      <p>Durasi peminjaman adalah 7 hari sejak tanggal peminjaman.</p>
    </div>
  </div>
</section>

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
<script>
  document.querySelectorAll(".faq-question").forEach(function(button) {
    button.addEventListener("click", function () {
      const item = this.parentElement;
      item.classList.toggle("open");
    });
  });
</script>

</body>

</html>