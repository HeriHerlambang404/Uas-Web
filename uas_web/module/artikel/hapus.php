<?php
// Pastikan tidak ada output apa pun sebelum ini
$db = new Database();
$id = $segments[2] ?? null;

if ($id) {
    $db->delete('artikel', "id = '$id'");
}

// Cara "Kasar" tapi paling ampuh jika header() ditolak server
echo '<!DOCTYPE html><html><head>';
echo '<meta http-equiv="refresh" content="0;url=/artikel/index">';
echo '<script>window.location.href="/uas_web/artikel/index";</script>';
echo '</head><body>';
echo 'Redirecting... <a href="/uas_web/artikel/index">Click here</a>';
echo '</body></html>';
exit();
