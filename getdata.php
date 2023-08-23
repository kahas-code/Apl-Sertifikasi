<?php
include 'config/database.php';
$id = $_GET['id'];

$exec = mysqli_query($koneksi, "SELECT * FROM comments WHERE uuid='" . $id . "'");

$data = mysqli_fetch_object($exec);
echo json_encode($data);
