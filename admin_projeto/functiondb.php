<?php

// Variaveis globais da aplicação
$host = $_SERVER['HTTP_HOST']; // localhost
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // /admin_projeto
$extra = "restritoAdmin.php";
define('HOME_URL', "http://$host$uri/$extra");
$connection = mysqli_connect('127.0.0.1', 'Tiago', '123', 'projeto21') or trigger_error(mysql_error());

$altImg;
$imoveldescricao;
$imovelImg;
$imovelID;

if (isset($_GET['del'])) {
    deleteImovel($_GET['del']);
}

if (isset($_POST['editar'])) {
    $imovel = validarImovel($_POST['editar']);
    validateForm($imovel);
}

if (isset($_POST['save']) && isset($_POST['form_imovel_alt'])) {
    saveImovel($_POST['save']);
}

function getImovel($imovelID)
{
    global $connection;
    $sql = "SELECT * FROM `imovel` WHERE `id` = '$imovelID'";
    $db_check = mysqli_query($connection, $sql);
    if (!$db_check) {
        echo '<p class="form_error">Erro ao validar imovel - Imovel</p>';
        return false;
    }
    return mysqli_fetch_assoc($db_check);
}

function validarImovel($imovelID)
{
    global $connection;
    $sql = "SELECT * FROM `imovel` WHERE `id` ='$imovelID'";
    $db_check = mysqli_query($connection, $sql);
    if (!$db_check) {
        echo '<p class="form_error">Internal error: Imove not exist </p>';
        return false;
    }
    return mysqli_fetch_assoc($db_check);
}

function validateForm($imovel)
{
    global $altimg, $imovelDescricao, $imovelID, $imovelImg;
    if (!empty($imovel['id'])) {
        $imovelID = $imovel['id'];
        $altimg = $imovel['altimg'];
        $imovelDescricao = $imovel['descricao'];
        $imovelImg = $imovel['imgPath'];
    } else {
        echo 'Imovel não encontrado';
    }
}

function saveImovel($imovelID)
{
    global $connection;
    $fetch_imovel = validarImovel($imovelID);
    if (!$fetch_imovel) {
        insertImovel();
    }
    $imovel_id = $fetch_imovel['id'];
    if (!empty($imovel_id)) {
        $sql = "UPDATE `imovel` SET `altimg` = '{$_POST['form_imovel_alt']}', `descricao` = '{$_POST['descricao']}', `imgPath` = '{$_POST['img_path']}' WHERE `id` = '$imovel_id'";
    }
    $query = mysqli_query($connection, $sql);
    if (!$query) {
        echo '<p class="form_error">Erro ao guardar imovel</p>';
    } else {
        echo '<p class="form_success">Imovel guardado com sucesso</p>';
    }
}

function insertImovel()
{
    global $connection;
    $altimg = $_POST['form_imovel_alt'];
    $descricao = $_POST['form_imovel_descricao'];
    $imgPath = $_POST['form_imovel_img'];
    $sql = "INSERT INTO `imovel` (altimg, descricao, imgPath) VALUES ('$altimg', '$descricao', '$imgPath')";
    if ($connection->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        return;
    }
}

function deleteImovel($imovelID)
{
    global $connection;
    if (!empty($imovelID)) {
        $imovel_id = (int) $imovelID;
        $sql = "DELETE FROM `imovel` WHERE `id` = $imovelID";
        if ($connection->query($sql) === true) {
            echo "Record deleted successfully\n";
        } else {
            echo "Error deleting record: " . $connection->error;
        }
    }
}

function get_imoveis_list()
{
    global $connection;
    $sql = "SELECT * FROM `imovel` ORDER BY id DESC";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        return $query;
    } else {
        exit;
    }
}
function get_imovel($imovelID)
{
    global $connection;
    $sql = "SELECT * FROM `imovel` WHERE `id`= $imovelID";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        return mysqli_fetch_assoc($query);
    } else {
        exit;
    }
}

function get_imovel_details($imovelID)
{
    global $connection;
    $sql = "SELECT localidade, valor FROM imovelinfo WHERE id = $id";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query)==1) {
        return mysqli_fetch_assoc($query);
    }
    exit;
}
