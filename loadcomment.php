<?php

include 'config/database.php';
session_start();

$id = $_POST['id'];

$exec = mysqli_query($koneksi, "SELECT a.*, b.name, b.uuid  FROM comments a JOIN users b ON a.user_id = b.uuid WHERE a.post_id='" . $id . "' ORDER BY a.created DESC;");



if (mysqli_num_rows($exec) <= 0) {
    echo "Belum Ada Komentar!";
} else {

    $data = mysqli_fetch_all($exec);

    $element = '';
    foreach ($data as $key => $value) {
        $element .= '<div class="row bg-secondary d-block mt-3 rounded p-2"> <div class="row"> <div class="col-md-6"><h5 class="mb-0"><b>' . $value[5] . '</b></h5> </div>
    <div class="col-md-6 text-end">' . ($value[6] == $_SESSION['userId'] ? '<div class="dropdown">
    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
        </svg>
    </button>
    <ul class="dropdown-menu dropdown-menu-dark bg-dark">
        <li><a class="dropdown-item edit" onclick="editcom(this)" data-id="' . $value[0] . '">edit</a></li>
        <li><a class="dropdown-item text-danger delcom" onclick="delcom(this)" data-id="' . $value[0] . '">delete</a></li>
    </ul>
</div>' : "") . '</div></div> <hr><p>' . $value[3] . '</p><hr class="mb-0"> <span class="text-end"><small class="text-end mt-0">' . $value[4] . '</small></span></div>';
    }

    echo $element;
}
