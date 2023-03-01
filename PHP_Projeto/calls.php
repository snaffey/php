<?php
use Phppot\Member;
use Phppot\func;

require_once __DIR__ . '/login/Model/Member.php';
require_once __DIR__ . '/functions.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "home.php";
define('HOME_URI', "http://$host$uri/$extra");

$func = new func();

$artigo_list = $func->listArtigos();

if(isset($_GET["id"])){   
    $artigoInfo = $func->get_artigo_details($_GET['id']); 
    $getArtigo = $func->get_artigo($_GET['id']);
    $artigo = $getArtigo[0];
    $artigoID = $artigo['ID'];
    $artigoNome = $artigo['Nome'];
    $artigoDesc = $artigo['Descrição'];
    $artigoImg = $artigo['Img'];
    $artigoAltImg = $artigo['AltImg'];
}


if (isset($_GET['del'])){
    $del = $_GET['del'];
    $func->delArtigo($del);
}

if (isset($_POST['edit'])) {
    $ArtigoID = $_POST['edit'];
    $artigo = $func->checkArtigo($ArtigoID);
    if ($artigo) {
        $ArtigoNome = $artigo[0]['Nome'];
        $ArtigoDesc = $artigo[0]['Descrição'];
        $ArtigoImg = $artigo[0]['Img'];
        $AltImg = $artigo[0]['AltImg'];
    }
}

if (isset($_POST['save'])) {
    $func->saveArtigo($_POST['save']);
}

	