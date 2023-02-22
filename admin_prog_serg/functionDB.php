<?
// Variaveis globais da aplicação
$host = $_SERVER['HTTP_HOST']; //localhost
// rftrim limpa o conteudo á dt do controlo
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "restritoAdmin.php";
define('HOME_URI', "http://$host$uri/$extra");
$connection = mysqli_connect('127.0.0.1', 'Tiago', '123', 'projeto21') or trigger_error(mysql_error());

$altimg;
$imovelDescricao;
$imovelImg;
$imovelID;

if (isset($_GET['del'])) {
	deleteImovel($_GET['del']);
}

if (isset($_POST['edit'])) {
  $imovel = validarImovel($_POST['edit']);
  validateForm($imovel);
}

if (isset($_POST['save']) && isset($_POST['form_imovel_alt']))
	saveImovel($_POST['save']);
	
function validarImovel($imovelID) {
	global $connection;
	$sql = "SELECT * FROM `imovel` WHERE `id` ='$imovelID'";
	$db_check = mysqli_query($connection, $sql);
	if (!$db_check){
		echo '<p class="form_error">Internal error: Imove not exist </p>';
		return false;
	}
	return mysqli_fetch_assoc($db_check);
}

function validateForm($imovel) {
	global $altimg, $imovelDescricao, $imovelID, $imovelImg;
	if (!empty($imovel['id'])){
		$imovelID = $imovel['id'];
		$altimg = $imovel['altimg'];
		$imovelDescricao = $imovel['descricao'];
		$imovelImg = $imovel['imgPath'];
	}else
		echo 'Imovel não encontrado';
}
	
	
function saveImovel($imovelID) {
	 global $connection;
	 $fetch_imovel = validarImovel($imovelID);
	 
	 if (!$fetch_imovel) {
		 insertImovel();
		 return;
	 }
	 $imovel_id = $fetch_imovel['id'];
	 if (!empty($imovel_id)){
	$sql = "UPDATE imovel SET altimg='" .
	$_POST['form_imovel_alt']."', descricao = '" .$_POST['form_imovel_descricao'].
	"', imgPath = '". $_POST['form_imovel_img']."' WHERE id =" . $imovel_id;
	$query = mysqli_query($connection, $sql);
	if (!$query) {
            echo '<p>Internal error. Data has not update.</p>';
            return;
    }else {
            echo '<p>Imovel successfully updated.</p>';
            return;
     }	
	} 
}

function insertImovel() {
	 global $connection;
	 $altimg = $_POST['form_imovel_alt'];
    $descricao = $_POST['form_imovel_descricao'];
    $imgPath = $_POST['form_imovel_img'];
	$sql = "INSERT INTO `imovel` (altimg, descricao, imgPath) VALUES ('$altimg', '$descricao', '$imgPath')";
	if($connection->query($sql) === TRUE)
		echo "New record created successfully";
	else {
		echo "Error: " . $sql . "<br>" . $connection->error;
		return;
	}
}

function deleteImovel($imovelID) {
	global $connection;
	    if(!empty($imovelID)) {
			$imovel_id = (int) $imovelID;
			$sql = "DELETE FROM `imovel` WHERE `id` = $imovelID";
			if ($connection->query($sql) === TRUE) {
				echo "Record deleted successfully\n";
			} else {
				echo "Error deleting record: " . $connection->error;
			}
	    }
}

function get_imoveis_list() {
	global $connection;
	$sql = "SELECT * FROM `imovel` ORDER BY id DESC";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 $res = mysqli_fetch_assoc($query);
		 return $query;
	 }else
		exit;
}
function get_imovel($imovelID) {
	global $connection;
	$sql = "SELECT * FROM `imovel` WHERE `id`= $imovelID";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 return mysqli_fetch_assoc($query);
	 }else
		exit;
}

function get_imovel_details($imovelID) {
	global $connection;
	$sql = "SELECT * FROM `imovelinfo` WHERE `id`= $imovelID";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 return mysqli_fetch_array($query);
	 }else
		exit;
}





?>