<?php
include 'library/uuid.php';
include 'config/config.php';
include 'config/database.php';
include 'library/hashtag.php';
session_start();

$id = format_uuidv4();
$post_id = $_POST['post_id'];
$user_id = $_SESSION['userId'];
$comment = $_POST['comment'];

mysqli_query($koneksi, "INSERT INTO comments VALUES('" . $id . "','" . $user_id . "','" . $post_id . "','" . $comment . "','" . date('Y-m-d H:i:s') . "')");


$ArrTags = carihastag($comment);
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
        mysqli_query($koneksi, "INSERT INTO comment_tags VALUES('" . $id . "','" . $tag_id . "')");
    }
}
