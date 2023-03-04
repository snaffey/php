<?php
use Phppot\funcDono;

$upOne = dirname(__DIR__, 1);

require_once __DIR__ . '/functionsDono.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = basename($_SERVER['PHP_SELF']);
define('HOME_URI', "http://$host$uri/$extra");

$func = new funcDono();

$artigo_list = $func->listArtigos();

if (basename($_SERVER['PHP_SELF']) == 'dono.php') {
    $utilizador_list_dono = $func->listUtilizadoresDono();
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
    $func->delUser($del);
}

if (isset($_POST['edit'])) {
    $UserID = $_POST['edit'];
    $user = $func->checkUser($UserID);
    if ($user) {

        $UserNivel = $user[0]['Nivel'];
        $UserUsername= $user[0]['username'];
    }
}

if (isset($_POST['save'])) {
    $func->saveUser($_POST['save']);
}

?>	