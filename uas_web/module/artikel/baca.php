<?php
$db = new Database();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $segments = explode('/', trim($url_path, '/'));
    $id = end($segments);
}

if (!$id || !is_numeric($id)) {
    die("<div class='container mt-5 alert alert-danger'>ID Artikel tidak valid!</div>");
}


$result = $db->query("SELECT * FROM artikel WHERE id = '$id'");
$artikel = $result->fetch_assoc();

if (!$artikel) {
    die("<div class='container mt-5 alert alert-warning'>Artikel dengan ID $id tidak ditemukan di database.</div>");
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <a href="/uas_web/artikel/index" class="btn btn-sm btn-outline-secondary mb-4">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>

            <div class="card shadow-sm border-0 p-4">
                <h1 class="fw-bold text-slate-800"><?= $artikel['judul']; ?></h1>
                <div class="text-muted small mb-4">
                    <i class="bi bi-calendar-event me-1"></i> Dipublikasikan pada: <?= $artikel['tanggal']; ?>
                </div>
                
                <hr>

                <div class="article-content mt-4" style="line-height: 1.8; font-size: 1.1rem; color: #333;">
                    <?= nl2br($artikel['isi']); ?>
                </div>
            </div>
        </div>
    </div>
</div>