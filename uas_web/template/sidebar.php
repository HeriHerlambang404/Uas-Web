<?php

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<aside class="bg-light border-end" style="width: 250px; min-height: 100vh; display: flex; flex-direction: column; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="p-4 flex-grow-1">
        <div class="mb-4 text-center">
            <h5 class="fw-bold text-dark m-0">Arthickellll</h5>
            <small class="text-muted text-uppercase tracking-wider" style="font-size: 10px;">Internal System</small>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <?php 
                    $home_path = ($role === 'admin') ? '/uas_web/home/index' : '/uas_web/home/indexuser'; 
                ?>
                <a class="nav-link border rounded bg-white shadow-sm text-dark d-flex align-items-center py-2 px-3" href="<?= $home_path ?>">
                    <i class="bi bi-house-door-fill me-3 text-primary"></i> 
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark d-flex align-items-center py-2 px-3" href="/uas_web/artikel/index">
                    <i class="bi bi-journal-text me-3 text-success"></i> 
                    <span>Daftar Artikel</span>
                </a>
            </li>

            <?php if ($role === 'admin') : ?>
            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark d-flex align-items-center py-2 px-3" href="/uas_web/user/tambah">
                    <i class="bi bi-person-plus-fill me-3 text-warning"></i> 
                    <span>Tambah User</span>
                </a>
            </li>
            <?php endif; ?>

            <li class="nav-item mb-2">
                <a class="nav-link border rounded bg-white shadow-sm text-dark d-flex align-items-center py-2 px-3" href="/uas_web/user/profile">
                    <i class="bi bi-person-circle me-3 text-info"></i> 
                    <span>My Profile</span>
                </a>
            </li>
            
            <li class="nav-item mt-4">
                <hr class="text-muted opacity-25">
                <a class="nav-link border rounded bg-white shadow-sm text-danger fw-bold d-flex align-items-center py-2 px-3" 
                   href="/uas_web/user/logout" 
                   onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    <i class="bi bi-box-arrow-right me-3"></i> 
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="p-3 border-top bg-white">
        <div class="d-flex align-items-center bg-light p-2 rounded">
            <div class="flex-shrink-0">
                <div class="bg-dark rounded text-white d-flex align-items-center justify-center" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="flex-grow-1 ms-2 overflow-hidden">
                <p class="mb-0 fw-bold text-dark text-truncate" style="font-size: 0.85rem;">
                    <?= $nama; ?>
                </p>
                <div class="d-flex align-items-center">
                    <span class="badge <?= ($role === 'admin') ? 'bg-primary' : 'bg-success' ?>" style="font-size: 0.6rem;">
                        <?= strtoupper($role); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
    .nav-link {
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    .nav-link:hover {
        transform: translateX(5px);
        background-color: #f8f9fa !important;
        border-color: #dee2e6 !important;
    }
    .nav-link i {
        font-size: 1.1rem;
    }
    .tracking-wider {
        letter-spacing: 0.1em;
    }
</style>