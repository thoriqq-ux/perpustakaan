<?php
require_once __DIR__ . '/core/autoload.php';

// Pagination config
$limit = 8;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = $page > 1 ? $page * $limit - $limit : 0;

// Search & Filter
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

$where = [];
if ($search !== '') {
    $safe = mysqli_real_escape_string($connect, $search);
    $where[] = "(judul LIKE '%$safe%' OR pengarang LIKE '%$safe%')";
}
if ($kategori !== '') {
    $safeKategori = mysqli_real_escape_string($connect, $kategori);
    $where[] = "kategori = '$safeKategori'";
}

$where_sql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// Query data buku
$query = "SELECT * FROM buku $where_sql LIMIT $start, $limit";
$result = mysqli_query($connect, $query);

// Hitung total buku untuk pagination
$total_query = "SELECT COUNT(*) AS total FROM buku $where_sql";
$total_result = mysqli_query($connect, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_pages = ceil($total_row['total'] / $limit);

// Ambil daftar kategori unik dari database
$kategori_query = "SELECT DISTINCT kategori FROM buku WHERE kategori IS NOT NULL AND kategori != ''";
$kategori_result = mysqli_query($connect, $kategori_query);
$daftar_kategori = [];
while ($row = mysqli_fetch_assoc($kategori_result)) {
    $daftar_kategori[] = $row['kategori'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Katalog Buku | Perpustakaan</title>
    <link rel="stylesheet" href="css/katalog.css" />
</head>

<body>

    <div class="container">
        <h1>Katalog Buku Perpustakaan</h1>
        <p>Lihat dan cari buku-buku yang tersedia.</p>

        <div class="back-button">
            <a href="index.php" class="btn-back">← Kembali</a>
        </div>

        <!-- Search Form -->
        <form method="get" class="search-bar" id="searchForm">
            <form method="get" class="search-bar">
                <input type="text" name="q" placeholder="Cari judul atau pengarang..."
                    value="<?= htmlspecialchars($search) ?>" />

                <select name="kategori">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($daftar_kategori as $item): ?>
                        <option value="<?= htmlspecialchars($item) ?>" <?= $kategori == $item ? 'selected' : '' ?>>
                            <?= htmlspecialchars($item) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Cari</button>
            </form>

            <!-- Book Cards -->
            <div class="cards-container" id="bookResults">
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <a href="detailBuku.php?id=<?= $row['id'] ?>" class="book-card-link">
                            <div class="book-card">
                                <h3><?= htmlspecialchars($row['judul']) ?></h3>
                                <p><strong>Pengarang:</strong> <?= htmlspecialchars($row['pengarang']) ?></p>
                                <p><strong>Kategori:</strong>
                                    <?= $row['kategori'] ? htmlspecialchars($row['kategori']) : 'Tidak ada' ?></p>
                                <p><strong>Tahun:</strong> <?= htmlspecialchars($row['tahun']) ?></p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="no-result">Tidak ada buku ditemukan.</p>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&q=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori) ?>">&laquo;
                            Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?= $i ?>&q=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori) ?>"
                            class="<?= $i == $page ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?= $page + 1 ?>&q=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori) ?>">Berikutnya
                            &raquo;</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="login-cta">
                <a href="member/login.php" class="btn-primary">Login untuk Meminjam Buku</a>
            </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const categorySelect = document.getElementById('categorySelect');
        const bookResults = document.getElementById('bookResults');

        function fetchBooks() {
            const query = searchInput.value.trim();
            const kategori = categorySelect.value;

            // Kirim request ke file pencarian
            fetch(`search.php?q=${encodeURIComponent(query)}&kategori=${encodeURIComponent(kategori)}`)
                .then(response => response.json())
                .then(data => {
                    bookResults.innerHTML = '';

                    if (data.length === 0) {
                        bookResults.innerHTML = '<p class="no-result">Tidak ada buku ditemukan.</p>';
                        return;
                    }

                    data.forEach(book => {
                        const card = document.createElement('div');
                        card.className = 'book-card';
                        card.innerHTML = `
            <h3>${book.judul}</h3>
            <p><strong>Pengarang:</strong> ${book.pengarang}</p>
            <p><strong>Tahun:</strong> ${book.tahun}</p>
            <p><strong>Penerbit:</strong> ${book.penerbit}</p>
            <p><strong>Kategori:</strong> ${book.kategori || 'Tidak ada'}</p>
          `;
                        bookResults.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Error fetching books:', error);
                    bookResults.innerHTML = '<p class="no-result">Terjadi kesalahan saat memuat data.</p>';
                });
        }

        // Live search saat mengetik
        searchInput.addEventListener('input', fetchBooks);

        // Filter saat pilih kategori
        categorySelect.addEventListener('change', fetchBooks);
    });
</script>

</html>

</html>

</html>