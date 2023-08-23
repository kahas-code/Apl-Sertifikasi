<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sosmed';


$koneksi = mysqli_connect($host, $username, $password, $db);

if (!$koneksi)
    echo "Gagal menghubungkan ke database";
