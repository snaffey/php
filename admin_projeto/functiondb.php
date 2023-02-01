<?php
// Variaveis globais da aplicação
$host = $_SERVER['HTTP_HOST']; // localhost
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // /admin_projeto
$extra = "restritoAdmin.php";
define('HOME_URL', "http://$host$uri/$extra");
$connection = mysqli_connect('localhost', 'root', '', 'projeto21') or trigger_error(mysqli_error());

$altImg;
$imovelDescricao;
$imovelImg;
$imovelID;

function get_imoveis_list(){
    global $connection;
    $sql = "SELECT * FROM 'imoveis' ORDER BY id DESC";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        return $res;
    }else {
        exit('Não foi possível encontrar os imóveis');
    }
}
?>