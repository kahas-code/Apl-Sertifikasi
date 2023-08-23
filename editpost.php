<?php


include 'config/database.php';
include 'config/config.php';
require 'library/uuid.php';
require 'library/hashtag.php';


$id = $_GET['id'];

$exec = mysqli_query($koneksi, "SELECT * FROM posts WHERE uuid='" . $id . "'");
$data = mysqli_fetch_array($exec);

if (!empty($_POST)) {

    $post = $_POST['post'];

    if (strlen($post) > 250) {
        header("location:dashboard.php?pesan=panjang");
        exit();
    } else if (strlen($post) <= 0) {
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
    $post_id = $id;

    $exec = mysqli_query($koneksi, "UPDATE posts SET post='" . $post . "', post_image='" . $targetFilePath . "',created='" . date('Y-m-d H:i:s') . "' WHERE uuid='" . $post_id . "'");
    echo mysqli_error($koneksi);

    $ArrTags = carihastag($post);
    if (count($ArrTags) > 0) {
        for ($i = 0; $i < count($ArrTags); $i++) {
            $tag_id = format_uuidv4();
            echo "count : " . $i . '<br>';
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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="<?= $baseURL ?>assets/img/at_icon-icons.com_50456.png">
    <link rel="stylesheet" href="<?= $baseURL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseURL ?>assets/css/font-awesome.min.css">
</head>

<body>

    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="row w-100 ">

                    <div class="col-md-6 ">
                        <a href="<?= $baseURL ?>dashboard.php" class="btn w-100 btn-info">
                            Home <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= $baseURL ?>profile.php" class="btn w-100">
                            Profile <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

    </div>
    <section class="mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <textarea name="post" id="post" cols="25" rows="10" placeholder="What do you think?" style="resize: none;" class="form-control"><?= $data[2] ?></textarea>
                            <input type="file" name="media" id="" class="form-control">
                            <button type="submit" class="btn btn-info d-flex">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="<?= $baseURL ?>assets/js/bootstrap.min.js"></script>
<script src="<?= $baseURL ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= $baseURL ?>assets/js/sweetalert.js"></script>


</html>