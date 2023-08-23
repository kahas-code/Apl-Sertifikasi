<?php
include 'config/config.php';
include 'config/database.php';

session_start();
if (!isset($_SESSION['email'])) {

    header("location:" . $baseURL . "index.php?pesan=belum_login");
}
if (!empty($_POST)) {
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

    mysqli_query($koneksi, "UPDATE users SET name='" . $_POST['nama'] . "', keterangan='" . $_POST['bio'] . "', picture='" . $targetFilePath . "' WHERE uuid='" . $_SESSION['userId'] . "'");
}
$exec = mysqli_query($koneksi, "SELECT * FROM users WHERE uuid='" . $_SESSION['userId'] . "'");
$data = mysqli_fetch_array($exec);
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
                        <a href="<?= $baseURL ?>dashboard.php" class="btn w-100 ">
                            Home <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= $baseURL ?>profile.php" class="btn w-100 btn-info">
                            Profile <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <section>
        <div class="container-fluid p-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <img class="rounded-circle shadow-lg " style="max-width:15vw" src="<?= $baseURL . ($data[6] == "" ? "assets/img/at_icon-icons.com_50456.png" : $data[6]) ?>" alt="">
                    <h2><?= $data[5] ?></h2>
                </div>
                <div class="col-md-5">
                    <p>BIODATA SAYA</p>
                    <?= $data[4] ?>
                </div>
                <div class="col-md-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profile">
                        Ganti Bio
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Ganti Bio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama">nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="bio">BIO</label>
                                            <input type="text" name="bio" id="bio" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="foto">Foto</label>
                                            <input type="file" name="foto" id="foto" class="form-control">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= $baseURL ?>assets/js/bootstrap.min.js"></script>

</body>

</html>