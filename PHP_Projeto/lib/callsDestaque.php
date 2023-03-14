<?php
use Phppot\FuncDestaque;

$upOne = dirname(__DIR__, 1);

require_once __DIR__ . '/functionsDestaque.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");
$extra = basename($_SERVER['PHP_SELF']);
define('HOME_URI', "http://$host$uri/$extra");

$func = new FuncDestaque();

$destaque_list = $func->listDestaque();

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $func->delDestaque($del);
}

if (isset($_POST['edit'])) {
    $Destaque = $_POST['edit'];
    $dest = $func->checkDestaque($Destaque);
    if ($dest) {
        $Dest = $dest[0]['Destaque'];
    }
}

if (isset($_POST['save'])) {
    $func->saveDestaque($_POST['save']);
}

?>	