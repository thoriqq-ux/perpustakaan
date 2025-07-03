<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil | Perpustakaan Digital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/landing.css">
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

        <!-- Tentang Kami -->
        <section id="tentang" style="margin-top: 60px;">
            <h2>Tentang Kami</h2>
            <p style="max-width: 700px; margin: 0 auto; padding: 1rem;">
                Perpustakaan Digital adalah platform berbasis online yang dirancang untuk memudahkan akses terhadap
                ribuan koleksi buku dari berbagai genre.
                Kami percaya bahwa pengetahuan tidak boleh dibatasi oleh ruang dan waktu.
                Oleh karena itu, kami hadir sebagai solusi perpustakaan modern yang bisa diakses kapan saja dan di mana
                saja.
            </p>
        </section>

        <!-- Visi & Misi -->
        <section id="visi" style="padding: 4rem 2rem; background-color: #f9fdfd;">
            <h2 style="text-align: center; color: #00695c; margin-bottom: 2rem;">Visi & Misi</h2>
            <div class="visi-misi-grid"
                style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 2rem; max-width: 1000px; margin: 0 auto; text-align: center;">

                <div class="visi"
                    style="flex: 1 1 400px; background-color: #e0f7fa; border-radius: 8px; padding: 1.5rem;">
                    <h3 style="color: #00796b; margin-bottom: 1rem;">🎯 Visi</h3>
                    <p>Menjadi platform perpustakaan digital terdepan yang memberikan akses pengetahuan tanpa batas bagi
                        seluruh lapisan masyarakat.</p>
                </div>

                <div class="misi"
                    style="flex: 1 1 400px; background-color: #e0f7fa; border-radius: 8px; padding: 1.5rem;">
                    <h3 style="color: #00796b; margin-bottom: 1rem;">📘 Misi</h3>
                    <ul style="list-style: disc inside; text-align: left;">
                        <li>Mengembangkan sistem perpustakaan berbasis teknologi modern.</li>
                        <li>Menyediakan koleksi buku berkualitas dari berbagai penerbit ternama.</li>
                        <li>Mempermudah proses pencarian, pinjam, dan baca buku secara online.</li>
                        <li>Mendorong minat membaca melalui pengalaman digital yang menyenangkan.</li>
                    </ul>
                </div>

            </div>
        </section>

        <!-- Tim Kami -->
        <section id="tim" style="padding: 4rem 2rem; background-color: #ffffff;">
            <h2 style="text-align: center; color: #00695c; margin-bottom: 2rem;">Tim Kami</h2>
            <div class="tim-cards"
                style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; max-width: 1200px; margin: 0 auto;">

                <!-- 1. M. Rafi Budi Trizaki -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/rafi.jpg" alt="M. Rafi Budi Trizaki"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">M. Rafi Budi Trizaki</h4>
                    <p style="color: #555;">202243502759</p>
                </div>

                <!-- 2. Arief Rifdul Haq -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/arief.jpg" alt="Arief Rifdul Haq"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">Arief Rifdul Haq</h4>
                    <p style="color: #555;">202243502757</p>
                </div>

                <!-- 3. Raditya Arrayan -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/raditya.jpg" alt="Raditya Arrayan"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">Raditya Arrayan</h4>
                    <p style="color: #555;">202243502711</p>
                </div>

                <!-- 4. Rafif Thoriq -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/rafif.jpg" alt="Rafif Thoriq"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">Rafif Thoriq</h4>
                    <p style="color: #555;">202243502763</p>
                </div>

                <!-- 5. Wijaya Guruh -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/wijaya.jpg" alt="Wijaya Guruh"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">Wijaya Guruh</h4>
                    <p style="color: #555;">20243502796</p>
                </div>

                <!-- 6. Fariz Fadliansyah -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/fariz.jpg" alt="Fariz Fadliansyah"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">Fariz Fadliansyah</h4>
                    <p style="color: #555;">202243502772</p>
                </div>

                <!-- 7. M. Dafa Aziz -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/dafa.jpg" alt="M. Dafa Aziz"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">M. Dafa Aziz</h4>
                    <p style="color: #555;">202243502770</p>
                </div>

                <!-- 8. Arfan .P -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/arfan.jpg" alt="Arfan .P"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">Arfan .P</h4>
                    <p style="color: #555;">202243502788</p>
                </div>

                <!-- 9. M. Khusni Mubarok -->
                <div class="tim-card"
                    style="background-color: #e0f7fa; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); text-align: center;">
                    <img src="assets/team/khusni.jpg" alt="M. Khusni Mubarok"
                        style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 1rem;">
                    <h4 style="color: #00796b; margin-bottom: 0.5rem;">M. Khusni Mubarok</h4>
                    <p style="color: #555;">202243502782</p>
                </div>

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

</body>

</html>