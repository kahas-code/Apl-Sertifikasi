<?php
session_start();
include 'config/database.php';
include 'config/config.php';
require 'library/uuid.php';
require 'library/hashtag.php';

$post = $_POST['post'];

if (strlen($post) > 250) {
    header("location:dashboard.php?pesan=panjang");
    exit();
}else if(strlen($post)<=0){
    header('location:dashboard.php?pesan=kosong');
    exit();
}

$targetFilePath = '';

if (isset($_FILES['media'])) {
    $file = $_FILES['media'];

    // Informasi tentang file yang diunggah
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Pindahkan file yang diunggah ke lokasi yang ditentukan
    $targetDirectory = 'uploads/'; // Ganti dengan direktori yang sesuai
    $targetFilePath = $targetDirectory . $fileName;

    if ($fileError === 0) {
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            echo "File berhasil diunggah.";
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file: " . $fileError;
    }
}
$post_id = format_uuidv4();

$exec = mysqli_query($koneksi, "INSERT INTO posts VALUES('" . $post_id . "','" . $_SESSION['userId'] . "','" . $post . "','" . $targetFilePath . "','" . date('Y-m-d H:i:s') . "')");
// echo mysqli_error($koneksi);

$ArrTags = carihastag($post);
if (count($ArrTags) > 0) {
    for ($i = 0; $i < count($ArrTags); $i++) {
        $tag_id = format_uuidv4();
        $exec = mysqli_query($koneksi, 'SELECT * FROM tags WHERE name="' . strtolower($ArrTags[$i]) . '"');
        if (mysqli_num_rows($exec) <= 0) {
            $exec = mysqli_query($koneksi, 'INSERT INTO tags VALUES("' . $tag_id . '","' . strtolower($ArrTags[$i]) . '")');
        } else {
            $data = mysqli_fetch_assoc($exec);
            $tag_id = $data['tag_id'];
        }
        mysqli_query($koneksi, "INSERT INTO post_tags VALUES('" . $post_id . "','" . $tag_id . "')");
    }
}

header('location:' . $baseURL . 'dashboard.php');
