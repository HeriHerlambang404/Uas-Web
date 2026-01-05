<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];
session_unset();
session_destroy();

if (!headers_sent()) {
    header("Location: /uas_web/user/login");
    exit();
} else {
    echo '<script>window.location.href="/uas_web/user/login";</script>';
    exit();
}
?>