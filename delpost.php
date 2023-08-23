<?php
include 'config/database.php';
$id = $_GET['id'];

try {
    mysqli_query($koneksi, "DELETE FROM posts WHERE uuid='" . $id . "'");
    mysqli_query($koneksi, "DELETE FROM comments WHERE post_id='" . $id . "'");
    echo "Berhasil Menghapus Record";
} catch (\Exception $err) {
    echo $err->getMessage();
}
