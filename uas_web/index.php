<?php
session_start();

include "config.php";
include "class/database.php";
include "class/form.php";

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));

$mod = (isset($segments[0]) && $segments[0] != '') ? $segments[0] : 'home';
$page = (isset($segments[1]) && $segments[1] != '') ? $segments[1] : 'index';

$isLoginPage = ($mod == 'user' && $page == 'login');
$isRegisterPage = ($mod == 'user' && $page == 'register'); // Izin akses register

if (!isset($_SESSION['login']) && !$isLoginPage && !$isRegisterPage) {
    header("Location: /uas_web/user/login");
    exit;
}

$file = "module/{$mod}/{$page}.php";

$noLayout = ($isLoginPage || $isRegisterPage);

if (!$noLayout) {
    include "template/header.php";
}

if (file_exists($file)) {
    include $file;
} else {
    echo '<div class="alert alert-danger">Halaman tidak ditemukan!</div>';
}

if (!$noLayout) {
    include "template/footer.php";
}
?>