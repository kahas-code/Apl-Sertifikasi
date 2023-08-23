<?php

// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'config/database.php';

// menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = $_POST['password'];



// // menyeleksi data admin dengan email dan password yang sesuai
$execute = mysqli_query($koneksi, "select * from users where email='$email'");



// // menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($execute);
if ($cek <= 0) {
    header("location:index.php?pesan=not_found");
    exit();
}
$data = mysqli_fetch_assoc($execute);

if (password_verify($password, $data['password'])) {
    $_SESSION['email'] = $email;
    $_SESSION['nama'] = $data['name'];
    $_SESSION['userId'] = $data['uuid'];

    header("location:dashboard.php");
} else {
    header("location:index.php?pesan=gagal");
}
