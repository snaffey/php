<?php
use Phppot\Member;
use Phppot\func;

require_once __DIR__ . '/login/Model/Member.php';
require_once __DIR__ . '/functions.php';

$AltImg;
$ArtigoNome;
$ArtigoDesc;
$ArtigoImg;
$ArtigoID;

$func = new func();

$artigo_list = $func->listArtigos();

$artigoInfo = $func->getArtigoDetails($_GET['id']);

$getArtigo = $func->getArtigo($_GET['id']);

if (isset($_GET['del'])){
    $del = $_GET['del'];
    $func->delArtigo($del);
}

if (isset($_POST['edit'])) {
    $Artigo = $func->checkArtigo($_POST['edit']);
    $func->validateForm($Artigo);
}

if (isset($_POST['save'])) {
    $func->saveArtigo($_POST);
}

	