<?php
session_start();
require_once __DIR__ . '/core/autoload.php';

// Ambil semua data dari tabel faq
$query = 'SELECT * FROM faq ORDER BY id ASC';
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FAQ | Perpustakaan Digital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="css/faq.css">
</head>

<body>

    <!-- Navbar -->
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

    <!-- Main Content -->
    <main class="main-content">

        <section id="faq" class="faq-section">
            <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>

            <!-- Tambah FAQ (Hanya Admin) -->
            <?php if (isset($_SESSION['login_admin'])): ?>
                <div style="text-align: right; margin-bottom: 1rem;">
                    <a href="admin/faq/tambah.php" class="btn-tambah-faq">+ Tambah FAQ</a>
                </div>
            <?php endif; ?>

            <div class="faq-container">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="faq-item">
                            <button class="faq-question"><?= htmlspecialchars($row['pertanyaan']) ?></button>
                            <div class="faq-answer">
                                <p><?= nl2br(htmlspecialchars($row['jawaban'])) ?></p>

                                <!-- Tombol Edit & Hapus (Hanya Admin) -->
                                <?php if (isset($_SESSION['login_admin'])): ?>
                                    <div class="faq-actions">
                                        <a href="admin/faq/edit.php?id=<?= $row['id'] ?>" class="btn-edit-faq">Edit</a>
                                        <a href="admin/faq/hapus.php?id=<?= $row['id'] ?>" class="btn-delete-faq"
                                            onclick="return confirm('Yakin ingin menghapus FAQ ini?')">Hapus</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="faq-item">
                        <p>Tidak ada pertanyaan tersedia.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <!-- Footer -->
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

    <!-- JavaScript Accordion -->
    <script>
        const questions = document.querySelectorAll(".faq-question");

        questions.forEach(question => {
            question.addEventListener("click", () => {
                const answer = question.nextElementSibling;
                const isOpen = answer.style.maxHeight;

                // Tutup semua jawaban lain
                document.querySelectorAll(".faq-answer").forEach(a => {
                    a.style.maxHeight = null;
                });

                // Buka hanya satu yang aktif
                if (!isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                }
            });
        });
    </script>

</body>

</html>