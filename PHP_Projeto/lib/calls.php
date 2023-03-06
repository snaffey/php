<?php
use Phppot\func;

$upOne = dirname(__DIR__, 1);

require_once __DIR__ . '/functions.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = basename($_SERVER['PHP_SELF']);
define('HOME_URI', "http://$host$uri/$extra");

$extra = 'galeria.php';
define('GALERIA', "http://$host$uri/$extra");

$func = new func();

$artigo_list = $func->listArtigos();

$destaque = $func->getArtigosDestaque();

if (basename($_SERVER['PHP_SELF']) == 'admin.php') {
    $artigo_list_dono = $func->listArtigosDono($_SESSION['Id']);
}

if(isset($_GET["id"])){   
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
        $ArtigoValor = $artigo[0]['Valor'];
        $ArtigoDesc = $artigo[0]['Descrição'];
        $ArtigoImg = $artigo[0]['Img'];
        $AltImg = $artigo[0]['AltImg'];
    }
}

if (isset($_POST['save'])) {
    $func->saveArtigo($_POST['save']);
}

if (isset($_POST['submit'])) {
    $func->insertMensagem();
}

?>	