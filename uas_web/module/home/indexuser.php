<?php
$db = new Database();

if ($_SESSION['role'] !== 'user') {
    header("Location: /uas_web/user/login");
    exit();
}
?>

<div class="container-fluid mt-4">
    <div class="p-5 mb-4 bg-white rounded-3 border shadow-sm">
        <div class="container-fluid py-2">
            <h1 class="display-5 fw-bold text-emerald-600">Halo, <?= $_SESSION['nama']; ?>! 👋</h1>
            <p class="col-md-8 fs-4 text-secondary">Selamat datang di E-Artikel. Senang melihat Anda kembali!</p>
            <hr class="my-4">
            <p class="text-muted">Di panel ini, Anda dapat membaca berbagai artikel menarik dan mengelola profil pribadi Anda.</p>
            
            <div class="d-flex gap-2 mt-4">
                <a href="/uas_web/artikel/index" class="btn btn-emerald btn-lg px-4 fw-bold shadow-sm">
                    <i class="bi bi-book me-2"></i> Mulai Membaca
                </a>
                <a href="/uas_web/user/profile" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-person-gear me-2"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white p-3">
                <div class="card-body">
                    <h6 class="text-uppercase opacity-75 small fw-bold">Role Anda</h6>
                    <h2 class="mb-0 text-capitalize"><?= $_SESSION['role']; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white p-3">
                <div class="card-body">
                    <h6 class="text-uppercase opacity-75 small fw-bold">Status Akun</h6>
                    <h2 class="mb-0">Aktif</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-emerald-600 { color: #059669; }
    .btn-emerald {
        background-color: #10b981;
        border-color: #10b981;
        color: white;
    }
    .btn-emerald:hover {
        background-color: #059669;
        border-color: #059669;
        color: white;
    }
</style>