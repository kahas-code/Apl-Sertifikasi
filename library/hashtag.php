<?php
function carihastag($string)
{
    $words = explode(" ", $string);

    $hashtags = [];


    // Memisahkan kata-kata antara teks biasa dan hashtag
    foreach ($words as $word) {
        if (strpos($word, "#") === 0) {
            $hashtags[] = $word; // Menyimpan hashtag
        }
    }
    return $hashtags;
}
