<?php
$db = new Database();
$id = $segments[2]; 

if (isset($id)) {
    $hapus = $db->delete('artikel', "id = '$id'");
    if ($hapus) {

        header("Location: /uas_web/artikel/index");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location.href='/uas_web/artikel/index';</script>";
    }
}
?>