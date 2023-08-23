<?php
include 'config/database.php';
$key = $_GET['key'];

$exec = mysqli_query($koneksi, "SELECT * FROM tags a JOIN post_tags b ON a.tag_id=b.tag_id JOIN posts c ON b.post_id=c.uuid JOIN comment_tags d ON a.tag_id=d.tag_id WHERE a.name LIKE '" . $key . "';");
$data = mysqli_fetch_array($exec);
if (mysqli_num_rows($exec) <= 0) {
    echo "Tidak ada data ditemukan";
}
