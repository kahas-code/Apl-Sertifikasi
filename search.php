<?php
include 'config/database.php';

$key = $_GET['key'];

function createelement($query)
{
    include 'config/config.php';
    $element = '';
    $posts = mysqli_fetch_all($query);
    foreach ($posts as $post) {
        $element .= '<div class="card mt-2">
        <div class="card-header align-items-center">
            <div class="row">
                <div class="col-md-6">
                    <h6>' . $post[5] . ', ' . $post[4]  . ' </h6>
                </div>
                <div class="col-md-6 text-end">
                    <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                            <li><a href="' . $baseURL . 'editpost.php?id=' . $post[3] . '" class="dropdown-item">edit</a></li>
                          
                            <li><a class="dropdown-item text-danger del" data-id="' . $post[0] . '">delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <p id="caption">' . $post[2] . '</p>
            <div class="row justify-content-evenly">' . ($post[3] == 'uploads/' ? '' : '<div class="col-md-4"><img src="' . $baseURL . $post[3] . '" alt="" style="max-width:20vw" class="shadow">
            </div>') . '
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <a class="btn d-flex komen" data-id="' . $post[0] . '">Comment <i class="fa fa-comment-o fs-4" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>';
    }
    return $element;
}

// sediakan variabel kosong untuk menampung string 
$el = '';

// cek hastag di tabel posts
$query1 = mysqli_query($koneksi, "SELECT c.uuid, c.user_id, c.post, c.post_image, c.created, d.name FROM `tags` a JOIN post_tags b ON a.tag_id=b.tag_id LEFT JOIN posts c ON b.post_id=c.uuid JOIN users d ON c.user_id=d.uuid WHERE a.name LIKE '%" . $key . "%';");
if (mysqli_num_rows($query1) > 0)
    $el .= createelement($query1);
// // cek hastag di table comments
$query2 = mysqli_query($koneksi, "SELECT d.uuid,c.user_id, d.post, d.post_image, d.created, e.name FROM tags a JOIN comment_tags b ON a.tag_id=b.tag_id JOIN comments c ON b.comment_id=c.uuid JOIN posts d ON c.post_id=d.uuid JOIN users e ON d.user_id=e.uuid WHERE a.name LIKE '%" . $key . "%';");
if (mysqli_num_rows($query2) > 0)
    $el .= createelement($query2);

// // apabila string kosong ambil semua postingan
if ($el == '') {

    $el = '<div class="card mt-2">
        <div class="card-body">
            <p>No post available</p>
        </div>
    </div>';
}
if ($key == '') {
    $query3 = mysqli_query($koneksi, "SELECT a.*, b.name FROM posts a JOIN users b");
    if (mysqli_num_rows($query3) > 0) {
        $el = createelement($query3);
    } else {
        $el = '<div class="card mt-2">
    <div class="card-body">
        <p>No post available</p>
    </div>
</div>';
    }
}
echo $el;
// echo json_encode(mysqli_fetch_all($query1));
