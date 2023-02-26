<?php 
if (!empty($_POST) AND ( empty($_POST['user']) OR empty($_POST['password']))) {
	 header("Location: index.php");
    exit;
}

//$connection = mysqli_connect('localhost', 'admin_back','1234') or trigger_error(mysql_error());
$connection = mysqli_connect('127.0.0.1', 'Tiago','123') or trigger_error(mysql_error());

mysqli_select_db($connection, 'desafio_al2021023') or trigger_error(mysql_error());

$user = mysqli_real_escape_string($connection, $_POST['user']);
$password = mysqli_real_escape_string($connection, $_POST['password']);

$sql = "SELECT * FROM `User` WHERE (`user` = '" . $user . "') ". "AND (`password` = '" . sha1($password) . "')";

$query = mysqli_query($connection, $sql);
if (mysqli_num_rows($query) != 1) {
    // Erro user não foi encontrado ou nao existe
    echo "Login inválido!";
    header("Location: index.php");
    exit;
}else{
	 $res = mysqli_fetch_assoc($query);
	 if (!isset($_SESSION))
		session_start();
	
	$_SESSION['UserID'] = $res['id'];
	$_SESSION['UserNome'] = $res['nome'];
	$_SESSION['UserNivel'] = $nivel = $res['nivel'];
	$_SESSION['UserEmail'] = $res['email'];
	
  switch ($nivel) {
	case 1:
	 header("Location: restritoAdmin.php");
	 break;
	case 2:
	 header("Location: restrito_1.php");
	 break;
	default:
     echo "User sem permissão!";
  }
}
?>