<?php
use Phppot\Member;
use Phppot\func;

require_once __DIR__ . '/login/Model/Member.php';
require_once __DIR__ . '/functions.php';

$func = new func();

$artigo_list = $func->listArtigos();




if (isset($_GET['del'])){
    $del = $_GET['del'];
    $func->delArtigo($del);
}

if (isset($_POST['edit'])) {
    $Artigo = checkArtigo($_POST['edit']);
    validateForm($Artigo);
}