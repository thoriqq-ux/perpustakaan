-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 27 Jun 2025 pada 14.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `username`, `password`, `nama`, `alamat`, `status`) VALUES
(1, 'rafif', '$2y$10$naRmuTDDAWyLMMledeQBkuvf9pRf/wNvup8g3Oz1qCe1yJ0GxQUkO', 'iq', 'ww', 1),
(2, 'test', '$2y$10$6AmDDUnITFlmwJIgEKK/teo/cbz3mBmpvzm5WGGMKbblTNkN8PZry', 'test', 'test', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `tahun`, `penerbit`, `kategori`, `sinopsis`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', '2005', 'Bentang Pustaka', 'Fiksi', 'Novel autobiografi yang menginspirasi ini mengisahkan perjalanan hidup sepuluh anak dari keluarga miskin di Pulau Belitung yang berjuang menempuh pendidikan di sekolah Muhammadiyah yang hampir tutup. Melalui mata Ikal, tokoh utama, pembaca diajak menyaksikan semangat luar biasa anak-anak Laskar Pelangi dalam menghadapi keterbatasan ekonomi, fasilitas sekolah yang memprihatinkan, dan tantangan hidup yang berat. Novel ini tidak hanya menceritakan tentang perjuangan mendapatkan pendidikan, tetapi juga tentang persahabatan yang tulus, cinta pertama, impian-impian besar, dan keajaiban yang terjadi ketika seseorang tidak pernah menyerah pada mimpinya. Dengan latar belakang kemiskinan dan ketertinggalan, kisah ini membuktikan bahwa pendidikan dan tekad yang kuat dapat mengubah nasib seseorang. Novel yang penuh humor, haru, dan inspirasi ini telah menjadi fenomena sastra Indonesia dan menginspirasi jutaan pembaca.'),
(2, 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', '2004', 'Republika Pustaka Utama', 'Religi', 'Novel religi yang sangat populer ini mengisahkan perjalanan spiritual dan cinta Fahri Abdullah Shiddiq, seorang mahasiswa Indonesia yang sedang menempuh pendidikan S2 di Universitas Al-Azhar, Kairo, Mesir. Kisah dimulai ketika Fahri, yang dikenal sebagai pemuda sholeh dan cerdas, harus menghadapi dilema cinta dengan empat wanita yang berbeda latar belakang: Aisha (gadis Mesir keturunan Palestina), Maria (tetangga Kristen Koptik), Nurul (teman sekampung dari Indonesia), dan Noura (gadis Prancis yang baru masuk Islam). Novel ini tidak hanya mengeksplorasi dinamika hubungan cinta yang Islami, tetapi juga mengangkat tema-tema penting seperti toleransi antar agama, perjuangan hidup mahasiswa di negeri orang, konflik Palestina-Israel, dan bagaimana menjalani kehidupan sesuai dengan nilai-nilai Islam di tengah modernitas. Melalui karakter Fahri, pembaca diajak memahami bagaimana Islam mengatur hubungan antar manusia dengan penuh kasih sayang dan kebijaksanaan.'),
(3, 'Hujan', 'Tere Liye', '2016', 'Gramedia Pustaka Utama', 'Romansa', 'Sebuah novel yang menyentuh tentang cinta, takdir, dan kenangan yang tidak pernah hilang meski hujan turun.Novel yang menyentuh hati ini mengisahkan Lail, seorang gadis SMA yang harus menghadapi kenyataan pahit ketika ayahnya meninggal dunia dalam kecelakaan pesawat. Kehidupan Lail berubah drastis dari seorang anak yang dimanja menjadi tulang punggung keluarga yang harus bekerja keras menghidupi ibu dan adik-adiknya. Di tengah perjuangannya menghadapi kemiskinan dan kesulitan hidup, Lail bertemu dengan Esok, seorang pemuda yang juga memiliki luka masa lalu. Hubungan mereka berkembang perlahan di tengah tantangan hidup yang tidak mudah. Novel ini menggambarkan bagaimana cinta sejati tidak hanya tentang kebahagiaan, tetapi juga tentang saling menguatkan dalam menghadapi badai kehidupan. Tere Liye dengan apik menggambarkan perjuangan hidup, keikhlasan dalam menerima takdir, dan bagaimana hujan yang turun tidak selalu membawa kesedihan, tetapi juga dapat menjadi berkah yang menyuburkan kehidupan. Kisah ini mengajarkan tentang ketabahan, keberanian, dan makna sejati dari cinta yang matang.'),
(4, 'Negeri 5 Menara', 'Ahmad Fuadi', '2009', 'Gramedia Pustaka Utama', 'Pendidikan', 'Novel inspiratif ini mengisahkan perjalanan Alif Fikri, seorang anak dari Maninjau, Sumatera Barat, yang harus meninggalkan kampung halamannya untuk menuntut ilmu di Pondok Madani (PM) Ponorogo, Jawa Timur. Awalnya Alif merasa terpaksa dan kecewa karena tidak bisa melanjutkan sekolah di SMA favorit, namun di pesantren inilah ia menemukan sahabat-sahabat terbaik dari lima daerah berbeda: Raja dari Medan, Said dari Surabaya, Dulmajid dari Sumenep, Baso dari Gowa, dan Atang dari Bandung. Mereka berenam kemudian dikenal sebagai \"Sahibul Menara\" dan memiliki motto \"Man Jadda Wa Jadda\" (siapa yang bersungguh-sungguh akan berhasil). Novel ini tidak hanya menceritakan kehidupan pesantren dengan segala dinamikanya, tetapi juga tentang persahabatan lintas suku dan budaya, perjuangan meraih cita-cita, dan bagaimana pendidikan pesantren membentuk karakter yang kuat. Melalui berbagai konflik internal dan eksternal, mereka belajar tentang arti kebersamaan, toleransi, dan pentingnya memiliki mimpi besar untuk masa depan.'),
(5, 'Sapi Dalam Hujan', 'Tere Liye', '2018', 'Gramedia Pustaka Utama', 'Romansa', 'Novel yang penuh metafora kehidupan ini mengisahkan tentang cinta yang tumbuh di tengah tantangan dan kesulitan hidup. Melalui tokoh utama yang menghadapi berbagai pergolakan batin dan konflik eksternal, Tere Liye mengeksplorasi bagaimana cinta sejati tidak selalu berjalan mulus seperti dalam dongeng. Kisah ini menggambarkan perjuangan seseorang untuk mempertahankan cinta di tengah badai kehidupan yang tidak kenal ampun. Seperti sapi yang tetap bertahan dalam hujan deras, tokoh-tokoh dalam novel ini menunjukkan ketabahan dan kesetiaan dalam menghadapi ujian hidup. Novel ini mengangkat tema tentang kesetiaan, pengorbanan, dan bagaimana cinta yang tulus akan selalu menemukan jalannya meskipun harus melalui rintangan yang berat. Dengan gaya bercerita yang khas Tere Liye, novel ini menyajikan kisah yang realistis namun tetap memberikan harapan bahwa setiap badai pasti akan berlalu dan setelahnya akan ada pelangi.'),
(6, 'Filosofi Teras', 'Henry Manampiring', '2018', 'Kompas', 'Pengembangan Diri', 'Buku pengembangan diri yang revolusioner ini memperkenalkan filosofi Stoikisme atau \"Filosofi Teras\" kepada pembaca Indonesia dengan pendekatan yang praktis dan mudah dipahami. Henry Manampiring berhasil mengadaptasi ajaran para filsuf Yunani kuno seperti Marcus Aurelius, Epictetus, dan Seneca menjadi panduan hidup yang relevan untuk kehidupan modern. Buku ini mengajarkan bagaimana mengelola emosi, menghadapi stres, dan menemukan ketenangan batin di tengah hiruk pikuk kehidupan sehari-hari. Konsep utama yang dibahas meliputi pemisahan antara hal-hal yang bisa dan tidak bisa kita kendalikan, pentingnya fokus pada proses daripada hasil, dan bagaimana mengubah perspektif terhadap masalah yang kita hadapi. Dengan menggunakan contoh-contoh konkret dari kehidupan sehari-hari, mulai dari masalah pekerjaan, hubungan personal, hingga tantangan hidup yang lebih besar, buku ini memberikan panduan praktis tentang kehidupan yang lebih tenang, bermakna, dan bahagia. Filosofi Teras mengajarkan bahwa kebahagiaan sejati bukan berasal dari pencapaian eksternal, tetapi dari kedamaian batin yang bisa kita kembangkan.'),
(7, 'Atomic Habits', 'James Clear', '2018', 'Avery', 'Motivasi', 'Mengajarkan cara membentuk kebiasaan positif yang dapat mengubah hidup secara signifikan.Buku groundbreaking ini mengungkap rahasia di balik pembentukan kebiasaan baik dan penghapusan kebiasaan buruk melalui pendekatan sains dan psikologi yang mendalam. James Clear membuktikan bahwa perubahan besar dalam hidup tidak memerlukan transformasi radikal, melainkan perbaikan kecil dan konsisten yang ia sebut sebagai \"atomic habits\" atau kebiasaan atomik. Buku ini menjelaskan empat hukum perubahan perilaku: membuatnya obvious (jelas), attractive (menarik), easy (mudah), dan satisfying (memuaskan). Clear menunjukkan bagaimana kebiasaan-kebiasaan kecil, ketika diakumulasikan dari waktu ke waktu, dapat menghasilkan hasil yang luar biasa melalui kekuatan compound effect. Dengan menggunakan penelitian dari bidang psikologi, neurosains, dan biologi, serta dilengkapi dengan studi kasus nyata dari atlet elit, seniman terkenal, dan pemimpin bisnis sukses, buku ini memberikan strategi praktis yang dapat langsung diterapkan. Pembaca akan belajar bagaimana merancang lingkungan yang mendukung kebiasaan baik, mengatasi kurangnya motivasi, dan membangun sistem yang membuat kesuksesan menjadi tak terelakkan.'),
(8, 'You Do You', 'Felxandro Ruby', '2020', 'Gramedia', 'Self Improvement', 'Buku motivasi kontemporer ini mengajak pembaca untuk menemukan dan menjadi versi terbaik dari diri mereka sendiri di era media sosial dan tekanan sosial yang tinggi. Felixandro Ruby menyajikan pandangan segar tentang bagaimana menjalani hidup yang autentik tanpa terjebak dalam perbandingan dengan orang lain atau standar kesuksesan yang dipaksakan oleh masyarakat. Buku ini mengeksplorasi berbagai aspek kehidupan modern, mulai dari career pressure, relationship goals, lifestyle choices, hingga mental health awareness. Ruby memberikan insight tentang pentingnya self-acceptance, mengenal passion dan purpose hidup, serta bagaimana membangun kepercayaan diri yang tidak bergantung pada validasi eksternal. Dengan gaya bahasa yang santai namun mendalam, buku ini cocok untuk generasi milenial dan Gen Z yang seringkali mengalami quarter-life crisis dan anxiety tentang masa depan. \"You Do You\" mengajarkan bahwa setiap orang memiliki timeline dan jalur kehidupan yang berbeda, dan kunci kebahagiaan adalah dengan menerima dan mengembangkan diri sesuai dengan nilai-nilai dan tujuan personal, bukan mengikuti ekspektasi orang lain.'),
(9, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '2014', 'Harper', 'Ilmu Sosial', 'Menggambarkan sejarah evolusi manusia dari zaman batu hingga era modern.Masterpiece intelektual ini menggambarkan sejarah evolusi manusia dari spesies yang tidak signifikan menjadi penguasa planet Bumi melalui tiga revolusi besar: Revolusi Kognitif (70.000 tahun yang lalu), Revolusi Pertanian (12.000 tahun yang lalu), dan Revolusi Sains (500 tahun yang lalu). Harari menganalisis bagaimana Homo sapiens berhasil mendominasi spesies manusia lainnya dan mengembangkan kemampuan unik untuk bekerja sama dalam kelompok besar melalui penciptaan mitos bersama seperti agama, uang, dan negara. Buku ini mengeksplorasi paradoks kemajuan manusia: bagaimana Revolusi Pertanian yang seharusnya membebaskan manusia justru menciptakan kerja yang lebih berat, bagaimana perkembangan teknologi membawa kemudahan sekaligus masalah baru, dan bagaimana konsep kebahagiaan manusia tidak serta merta meningkat seiring dengan kemajuan peradaban. Harari juga membahas masa depan manusia dengan munculnya artificial intelligence, genetic engineering, dan kemungkinan evolusi Homo sapiens menjadi Homo deus. Dengan pendekatan multidisipliner yang menggabungkan antropologi, sejarah, biologi, dan filosofi, buku ini memberikan perspektif yang mengubah cara pandang tentang tempat manusia di alam semesta.'),
(10, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', '1997', 'Plata Publishing', 'Keuangan', 'Mengajarkan prinsip-prinsip keuangan dasar untuk membangun kemandirian finansial.Buku revolusioner tentang edukasi finansial ini mengkontraskan dua filosofi keuangan yang berbeda melalui figure \"ayah kaya\" dan \"ayah miskin\" dalam kehidupan Kiyosaki. Ayah kandungnya (ayah miskin) adalah seorang akademisi yang berpendidikan tinggi namun selalu kesulitan keuangan, sementara ayah temannya (ayah kaya) adalah seorang pengusaha yang sukses meskipun tidak menyelesaikan pendidikan formal. Melalui perbandingan ini, Kiyosaki mengajarkan perbedaan fundamental antara working for money dan making money work for you. Buku ini memperkenalkan konsep-konsep penting seperti aset versus liabilitas, pentingnya financial literacy, cash flow quadrant (Employee, Self-employed, Business owner, Investor), dan bagaimana membangun passive income. Kiyosaki menantang paradigma konvensional tentang keamanan kerja, pentingnya rumah sebagai aset, dan sistem pendidikan yang tidak mengajarkan literasi keuangan. Dengan menggunakan contoh-contoh praktis dan analogi yang mudah dipahami, buku ini memberikan dasar-dasar membangun kekayaan melalui investasi, real estate, dan bisnis. \"Rich Dad Poor Dad\" telah mengubah cara jutaan orang memandang uang dan menjadi starting point bagi banyak orang untuk memulai journey menuju financial independence.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`),
  ADD CONSTRAINT `pinjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
