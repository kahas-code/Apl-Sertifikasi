<?php
include 'config/config.php';
include 'config/database.php';

session_start();
if (!isset($_SESSION['email'])) {
    header("location:" . $baseURL . "index.php?pesan=belum_login");
} ?>
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
                        <?php
                        if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "panjang") {
                                echo '<div class="alert alert-danger" role="alert">
                                   Postingan tidak boleh lebih dari 250 karakter!</div>';
                            } else if ($_GET['pesan'] == "kosong") {
                                echo '<div class="alert alert-danger" role="alert">
                                   Caption harus di isi!</div>';
                            }
                        }
                        ?>
                        <form action="posthandler.php" method="POST" enctype="multipart/form-data">
                            <textarea name="post" id="post" cols="25" rows="10" placeholder="What do you think?" style="resize: none;" class="form-control"></textarea>
                            <input type="file" name="media" id="" class="form-control">
                            <button type="submit" class="btn btn-info d-flex">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <input type="text" name="" id="search" class="form-control" placeholder="cari postingan dengan tags">
                    <div id="tagssearch">
                        <?php
                        // $exec = mysqli_query($koneksi, "SELECT * FROM `posts`");
                        $exec = mysqli_query($koneksi, "SELECT a.uuid, a.post, a.post_image, b.name, DATE_FORMAT(a.created, '%D %M %Y %H:%i:%s') as `readable` FROM `posts` a JOIN users b ON a.user_id = b.uuid ORDER BY a.created DESC;");
                        if (mysqli_num_rows($exec) > 0) {
                            $data = mysqli_fetch_all($exec);
                            foreach ($data as $key => $value) { ?>
                                <div class="card mt-2">
                                    <div class="card-header align-items-center">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><?= $value[3] . ', ' . $value[4]  ?> </h6>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <div class="dropdown">
                                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                        </svg>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                                                        <li><a href="<?= $baseURL ?>editpost.php?id=<?= $value[0] ?>" class="dropdown-item">edit</a></li>
                                                        <!-- <li><a class="dropdown-item text-warning" href="#">report</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider border-top border-secondary">
                                                    </li> -->
                                                        <li><a class="dropdown-item text-danger del" data-id="<?= $value[0] ?>">delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <p id="caption"><?= $value[1] ?></p>
                                        <div class="row justify-content-evenly">
                                            <?= ($value[2] == 'uploads/' ? '' : ' <div class="col-md-4">
                                            <img src="' . $baseURL . $value[2] . '" alt="" style="max-width:20vw" class="shadow">
                                        </div>') ?>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <a class="btn d-flex komen" data-id="<?= $value[0] ?>">Comment <i class="fa fa-comment-o fs-4" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <p>No post available</p>
                                </div>
                            </div>
                        <?php }; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modalkomen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Komentar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="komentar" class="p-3"></div>
                    <form action="" id="addcomment">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Tambahkan komentar" name="comment" aria-label="Tambahkan komentar" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><button type="submit" class="kirim btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button></span>
                            </div>
                            <input type="hidden" name="post_id">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editcoment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="comment">
                        <div class="form-group mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <textarea class="form-control" name="comment" id="textcomment" cols="25" rows="10" style="resize: none;"></textarea>
                            <button type="submit" class="btn btn-secondary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="<?= $baseURL ?>assets/js/bootstrap.min.js"></script>
<script src="<?= $baseURL ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= $baseURL ?>assets/js/sweetalert.js"></script>
<script>
    $('.komen').click(function() {
        let comment_id = $(this).data("id");
        loadkomen(comment_id);
        $('input[name="post_id"]').val(comment_id);
        $('#modalkomen').modal('show');
    })

    function loadkomen(id) {

        $.ajax({
            url: '<?= $baseURL ?>loadcomment.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $('#komentar').html(response);
            }
        })
    }
    $('#addcomment').submit(function(event) {
        event.preventDefault();
        let FormData = $(this).serialize();

        $.ajax({
            url: '<?= $baseURL ?>addcomment.php',
            type: 'POST',
            data: FormData,
            success: function(data) {
                loadkomen($('input[name="post_id"]').val());
                $('input[name="comment"]').val('');
                console.log(FormData);
            }
        })
    })
    $('.del').on('click', function(event) {
        event.preventDefault();
        let id = $(this).data("id");
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Postingan akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= $baseURL ?>delpost.php?id=' + id,
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    }
                })
            }
        })
    })

    function editcom(el) {
        $.ajax({
            url: '<?= $baseURL ?>getdata.php?id=' + $(el).data('id'),
            type: 'GET',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                $('form#comment').attr('action', 'updatecomment.php?id=' + $(el).data("id"));
                $('textarea#textcomment').text(data.comment);
            }
        })
        $('#editcoment').modal('show');
    }
    $('.edit').on('click', function(event) {
        let id = $(this).data("id");
    })

    $('form#comment').submit(function(event) {
        event.preventDefault();
        let FormData = $(this).serialize();
        let url = $(this).attr('action');

        $.ajax({
            url: '<?= $baseURL ?>' + url,
            type: 'POST',
            data: FormData,
            success: function(response) {
                loadkomen($('input[name="post_id"]').val());
                $('#editcoment').modal('hide');

            }
        })
    })
    $('#search').keyup(function(event) {
        event.preventDefault();
        let value = $(this).val();
        $.ajax({
            url: '<?= $baseURL ?>search.php?key=#' + value,
            type: "GET",
            success: function(response) {
                $('#tagssearch').html(response);
            }
        })
    })
</script>

</html>