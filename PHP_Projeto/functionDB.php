<?
// Variaveis globais da aplicação
$host = $_SERVER['HTTP_HOST']; //localhost
// rftrim limpa o conteudo á dt do controlo
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "restritoAdmin.php";
define('HOME_URI', "http://$host$uri/$extra");
$connection = mysqli_connect('127.0.0.1', 'Tiago', '123', 'desafio_al2021023') or trigger_error(mysql_error());

$altimg;
$ArtigoDesc;
$ArtigoImg;
$ArtigoID;

if (isset($_GET['del'])) {
	delArtigo($_GET['del']);
}

if (isset($_POST['edit'])) {
  $Artigo = checkArtigo($_POST['edit']);
  validateForm($Artigo);
}

if (isset($_POST['save']) && isset($_POST['form_Artigo_alt']))
	saveArtigo($_POST['save']);
	
function checkArtigo($ArtigoID) {
	global $connection;
	$sql = "SELECT * FROM `Artigo` WHERE `id` ='$ArtigoID'";
	$db_check = mysqli_query($connection, $sql);
	if (!$db_check){
		echo '<p class="form_error">Internal error: Artigo not exist </p>';
		return false;
	}
	return mysqli_fetch_assoc($db_check);
}

function validateForm($Artigo) {
	global $altimg, $ArtigoDesc, $ArtigoID, $ArtigoImg;
	if (!empty($Artigo['id'])){
		$ArtigoID = $Artigo['id'];
		$altimg = $Artigo['altimg'];
		$ArtigoDesc = $Artigo['descricao'];
		$ArtigoImg = $Artigo['imgPath'];
	}else
		echo 'Artigo não encontrado';
}
	
	
function saveArtigo($ArtigoID) {
	 global $connection;
	 $fetch_Artigo = checkArtigo($ArtigoID);
	 
	 if (!$fetch_Artigo) {
		 insertArtigo();
		 return;
	 }
	 $Artigo_id = $fetch_Artigo['id'];
	 if (!empty($Artigo_id)){
	$sql = "UPDATE Artigo SET altimg='" .
	$_POST['form_Artigo_alt']."', descricao = '" .$_POST['form_Artigo_descricao'].
	"', imgPath = '". $_POST['form_Artigo_img']."' WHERE id =" . $Artigo_id;
	$query = mysqli_query($connection, $sql);
	if (!$query) {
            echo '<p>Internal error. Data has not update.</p>';
            return;
    }else {
            echo '<p>Artigo successfully updated.</p>';
			header("Location: " . $_SERVER['PHP_SELF']);
            return;
     }	
	} 
}

function insertArtigo() {
	global $connection;
	if(empty($_POST['form_Artigo_alt']) || empty($_POST['form_Artigo_descricao']) || empty($_POST['form_Artigo_img'])) {
		echo "One of the fields is empty";
		return;
	} else {
		$altimg = $_POST['form_Artigo_alt'];
		$descricao = $_POST['form_Artigo_descricao'];
		$imgPath = $_POST['form_Artigo_img'];
		$sql = "INSERT INTO Artigo (altimg, descricao, imgPath) VALUES ('$altimg', '$descricao', '$imgPath')";
		if($connection->query($sql) === TRUE) {
			echo "New record created successfully";
			// Reload the page to the normal state
			header("Location: " . $_SERVER['PHP_SELF']);
			exit;
		} else {
			echo "Error: " . $sql . "
			" . $connection->error;
			return;
		}
	}
}

function delArtigo($ArtigoID) {
	global $connection;
	    if(!empty($ArtigoID)) {
			$Artigo_id = (int) $ArtigoID;
			$sql = "DELETE FROM `Artigo` WHERE `id` = $ArtigoID";
			if ($connection->query($sql) === TRUE) {
				echo "Record deleted successfully\n";
				header("Location: " . $_SERVER['PHP_SELF']);
			} else {
				echo "Error deleting record: " . $connection->error;
			}
	    }
}

function get_artigos_list() {
	global $connection;
	$sql = "SELECT * FROM `Artigo` ORDER BY id DESC";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 $res = mysqli_fetch_assoc($query);
		 return $query;
	 }else
		exit;
}
function get_artigo($ArtigoID) {
	global $connection;
	$sql = "SELECT * FROM `Artigo` WHERE `id`= $ArtigoID";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 return mysqli_fetch_assoc($query);
	 }else
		exit;
}

function get_artigo_details($ArtigoID) {
	global $connection;
	$sql = "SELECT * FROM `ArtigoInfo` WHERE `ID`= $ArtigoID";
	$query = mysqli_query($connection, $sql);
	if (mysqli_num_rows($query) > 0) {
		return mysqli_fetch_array($query);
	}
	else {
		return FALSE;
	}
}





?>