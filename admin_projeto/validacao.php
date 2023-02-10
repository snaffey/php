<?php

if (!empty($_POST) AND (empty($_POST['User']) OR empty($_POST['Password']))) {
    header("Location: index.php"); exit;
}

$connection = mysqli_connect('127.0.0.1', 'Tiago', '123') or trigger_error(mysqli_error());

mysqli_select_db($connection, 'projeto21') or trigger_error(mysqli_error());

?>