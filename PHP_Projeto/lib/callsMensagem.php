<?php
use Phppot\FuncMsg;

$upOne = dirname(__DIR__, 1);

require_once __DIR__ . '/functionMensagem.php';

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");
$extra = basename($_SERVER['PHP_SELF']);
define('HOME_URI', "http://$host$uri/$extra");

$func = new FuncMsg();

$msg_list = $func->listMsg();

if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $func->delMsg($del);
}

?>	