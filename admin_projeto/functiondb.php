<?php
// Variaveis globais da aplicação
$host = $_SERVER['HTTP_HOST']; // localhost
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // /admin_projeto
$extra = "restritoAdmin.php";
define('HOME_URL', "http://$host$uri/$extra");
$connection = mysqli_connect('127.0.0.1', 'Tiago', '123', 'projeto21') or trigger_error(mysqli_error());

$altImg;
$imoveldescricao;
$imovelImg;
$imovelID;

function get_imoveis_list(){
    global $connection;
    $sql = 'SELECT * FROM `imovel` ORDER BY id ASC';
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0){
        $res = mysqli_fetch_assoc($query);
        return $query;
    }
    exit;
}

function get_imovel($id){
    global $connection;
    $sql = 'SELECT * FROM `imovel` WHERE `id`='.$id;
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query)==1)
        return mysqli_fetch_assoc($query);
    exit;
}

function getimovelinfo($id){
    global $connection;
    $sql = "SELECT localidade, valor FROM imovelinfo WHERE id = $id";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query)==1)
        return mysqli_fetch_assoc($query);
    exit;
}


?>