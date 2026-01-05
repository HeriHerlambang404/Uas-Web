<?php
$db = new Database();

$search = isset($_GET['search']) ? $_GET['search'] : '';

$limit = 5; 
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$queryCount = "SELECT COUNT(*) as total FROM artikel WHERE judul LIKE '%$search%'";
$countRes = $db->query($queryCount);
$totalData = $countRes->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

$query = "SELECT * FROM artikel WHERE judul LIKE '%$search%' ORDER BY tanggal DESC LIMIT $limit OFFSET $offset";
$result = $db->query($query);

$role = $_SESSION['role'] ?? 'user';
?>

<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold"><i class="bi bi-journal-text text-primary me-2"></i>Daftar Artikel</h3>
            <p class="text-muted small">Menampilkan <?= $totalData ?> artikel.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <?php if ($role === 'admin'): ?>
                <a href="/uas_web/artikel/tambah" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Baru
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <form action="" method="GET" class="d-flex shadow-sm">
                <input type="text" name="search" class="form-control" placeholder="Cari judul artikel..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-dark ms-1">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Judul Artikel</th>
                        <th width="250" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="align-middle">
                            <td class="ps-4">
                                <span class="fw-medium"><?= $row['judul']; ?></span><br>
                                <small class="text-muted" style="font-size: 0.75rem;"><?= $row['tanggal'] ?></small>
                            </td>
                            <td class="text-center">
                                <a href="/uas_web/artikel/baca/<?= $row['id']; ?>" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <?php if ($role === 'admin'): ?>
                                    <a href="/uas_web/artikel/ubah/<?= $row['id']; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/uas_web/artikel/hapus/<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center py-4 text-muted">Artikel tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if ($totalPages > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-item page-link" href="?p=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
            </li>

            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?p=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?p=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>