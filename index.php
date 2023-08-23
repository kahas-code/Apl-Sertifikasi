<?php
include 'config/config.php';
include 'config/database.php';
session_start();
if (isset($_SESSION['email'])) {

    header('location:' . $baseURL . 'dashboard.php');
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="<?= $baseURL ?>assets/img/at_icon-icons.com_50456.png">
    <link rel="stylesheet" href="<?= $baseURL ?>assets/css/bootstrap.min.css">

</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <h3 class="mb-5 text-center">KAHAS </h3>
                            <!-- cek pesan notifikasi -->
                            <?php
                            if (isset($_GET['pesan'])) {
                                if ($_GET['pesan'] == "gagal") {
                                    echo '<div class="alert alert-danger" role="alert">
                                    Login gagal! username dan password salah!</div>';
                                } else if ($_GET['pesan'] == "logout") {
                                    echo '<div class="alert alert-success" role="alert">
                                    Anda telah berhasil logout</div>';
                                } else if ($_GET['pesan'] == "belum_login") {
                                    echo '<div class="alert alert-danger" role="alert">
                                    Anda harus login untuk mengakses aplikasi </div>';
                                } else if ($_GET['pesan'] == 'not_found') {
                                    echo '<div class="alert alert-danger" role="alert">
                                    Akun tidak ditemukan!</div>';
                                }
                            }
                            ?>
                            <form action="<?= $baseURL ?>Auth.php" method="POST">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="typeEmailX-2">Email</label>
                                    <input name="email" type="text" id="typeEmailX-2" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                    <input name="password" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="<?= $baseURL ?>assets/js/bootstrap.min.js"></script>

</html>