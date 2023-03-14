<?php
use Phppot\FuncImg;

$upOne = dirname(__DIR__, 1);

require_once __DIR__ . '/functionsImgs.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");
$extra = basename($_SERVER['PHP_SELF']);
define('HOME_URI', "http://$host$uri/$extra");

define('IMG_DIR', "http://$host");

$func = new FuncImg();

if (isset($_GET['ID'])) {
    $Id = $_GET['ID'];
}

$imgs_list = $func->listImgs($Id);

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $func->delImg($del);
}

if (isset($_POST['save'])) {
    $func->insertGaleria($_POST['save']);
}


?>	