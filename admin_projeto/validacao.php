<?php

if (!empty($_POST) and (empty($_POST['User']) or empty($_POST['Password']))) {
    header("Location: index.php");
    exit;
}

$connection = mysqli_connect('127.0.0.1', 'Tiago', '123') or trigger_error(mysqli_error());

mysqli_select_db($connection, 'projeto21') or trigger_error(mysqli_error());

$user = mysqli_real_escape_string($connection, $_POST['User']);
$password = mysqli_real_escape_string($connection, $_POST['Password']);

$sql = "SELECT * FROM `users` WHERE (`User` = '".$user."') AND (`Password` = '".sha1($password)."') AND (`ativo` = 1) LIMIT 1";

$query = mysqli_query($connection, $sql);
if (mysqli_num_rows($query) != 1) {
    echo "Login inválido!";
    exit;
} else {
    $resultado = mysqli_fetch_assoc($query);
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['UserID'] = $resultado['id'];
    $_SESSION['UserNome'] = $resultado['nome'];
    $_SESSION['UserNivel'] = $nivel = $resultado['nivel'];
    $_SESSION['UserEmail'] = $resultado['email'];

    switch ($nivel) {
        case 1:
            header("Location: restritoAdmin.php");
            exit;
            break;
        case 2:
            header("Location: restrito_1.php");
            exit;
            break;
        default:
            echo "Nível de acesso não identificado!";
    }
}
