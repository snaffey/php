<?php

include_once './lib/DataSource.php';
include_once './Model/Member.php';

function listArtigos() {
    $sql = "SELECT * FROM `Artigo` ORDER BY ID ASC";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        return $query;
    } else {
        exit;
    }
}

