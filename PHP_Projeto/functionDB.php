<?
// Variaveis globais da aplicação
$host = $_SERVER['HTTP_HOST']; //localhost
// rftrim limpa o conteudo á dt do controlo
$uri = rtrim(dirname($_SERVER['PHP_SELF']),"/\\");
$extra = "restritoAdmin.php";
define('HOME_URI', "http://$host$uri/$extra");
$connection = mysqli_connect('127.0.0.1', 'Tiago', '123', 'desafio_al2021023') or trigger_error(mysql_error());

$AltImg;
$ArtigoNome;
$ArtigoDesc;
$ArtigoImg;
$ArtigoID;

if (isset($_GET['del'])) {
	delArtigo($_GET['del']);
}

if (isset($_POST['edit'])) {
  $Artigo = checkArtigo($_POST['edit']);
  valIDateForm($Artigo);
}

if (isset($_POST['save']) && isset($_POST['form_Artigo_alt']))
	saveArtigo($_POST['save']);
	
function checkArtigo($ArtigoID) {
	global $connection;
	$sql = "SELECT * FROM `Artigo` WHERE `ID` ='$ArtigoID'";
	$db_check = mysqli_query($connection, $sql);
	if (!$db_check){
		echo '<p class="form_error">Internal error: Artigo not exist </p>';
		return false;
	}
	$artigo = mysqli_fetch_assoc($db_check);
	if (!$artigo){
		echo '<p class="form_error">Internal error: Artigo not exist </p>';
		return false;
	}
	return $artigo;
}

function valIDateForm($Artigo) {
    global $AltImg, $ArtigoNome, $ArtigoDesc, $ArtigoID, $ArtigoImg;
    if (empty($Artigo)) {
        echo 'Artigo não encontrado';
        return false;
    }
    $ArtigoID = $Artigo['ID'];
	$ArtigoNome = $Artigo['Nome'];
    $AltImg = $Artigo['AltImg'];
    $ArtigoDesc = $Artigo['Descrição'];
    $ArtigoImg = $Artigo['Img'];
    return true;
}
	
	
function saveArtigo($ArtigoID) {
	 global $connection;
	 $fetch_Artigo = checkArtigo($ArtigoID);
	 
	 if (!$fetch_Artigo) {
		 insertArtigo();
		 return;
	 }
	 $Artigo_ID = $fetch_Artigo['ID'];
	 if (!empty($Artigo_ID)){
	$sql = "UPDATE Artigo SET Nome='" . $_POST['form_Artigo_nome'] . "', AltImg = '" . 
	$_POST['form_Artigo_alt']."', Descrição = '" .$_POST['form_Artigo_Descrição'].
	"', Img = '". $_POST['form_Artigo_img']."' WHERE ID =" . $Artigo_ID;
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
	if(empty($_POST['form_Artigo_alt']) || empty($_POST['form_Artigo_Descrição']) || empty($_POST['form_Artigo_img']) || empty($_POST['form_Artigo_nome'])) {
		echo "One of the fields is empty";
		return;
	} else {
		$ArtigoNome = $_POST['form_Artigo_nome'];
		$AltImg = $_POST['form_Artigo_alt'];
		$Descrição = $_POST['form_Artigo_Descrição'];
		$Img = $_POST['form_Artigo_img'];
		$IdDono = 
		$sql = "INSERT INTO Artigo (Nome, AltImg, Descrição, Img) VALUES ('$ArtigoNome', '$Descrição', '$AltImg',  '$Img')";
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
			$Artigo_ID = (int) $ArtigoID;
			$sql = "DELETE FROM `Artigo` WHERE `ID` = $Artigo_ID";
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
	$sql = "SELECT * FROM `Artigo` ORDER BY ID DESC";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 $res = mysqli_fetch_assoc($query);
		 return $query;
	 }else
		exit;
}
function get_artigo($ArtigoID) {
	global $connection;
	$sql = "SELECT * FROM `Artigo` WHERE `ID`= $ArtigoID";
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