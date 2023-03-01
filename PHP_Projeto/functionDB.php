<?

$connection = mysqli_connect('127.0.0.1', 'Tiago', '123', 'desafio_al2021023') or trigger_error(mysql_error());

$AltImg;
$ArtigoNome;
$ArtigoDesc;
$ArtigoImg;
$ArtigoID;

if (isset($_POST['edit'])) {
  $Artigo = checkArtigo($_POST['edit']);
  valIDateForm($Artigo);
}

if (isset($_POST['save']) && isset($_POST['form_Artigo_alt']))
	saveArtigo($_POST['save']);


	
	
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
	if(empty($_POST['form_Artigo_alt']) || empty($_POST['form_Artigo_Descrição']) || empty($_POST['form_Artigo_img']) || empty($_POST['form_Artigo_nome'])) {
		echo "One of the fields is empty";
		return;
	} else {

		global $connection;
		$query = "SELECT MAX(ID) as max_id FROM Artigo";
		$result = mysqli_query($connection, $query);
		if (!empty($result)){
			$maxID = intval($result->fetch_assoc()["max_id"]);
			$_POST["idArtigo"] = $maxID + 1;
		}

		$ID = $_POST['idArtigo'];
		$ArtigoNome = $_POST['form_Artigo_nome'];
		$AltImg = $_POST['form_Artigo_alt'];
		$Descrição = $_POST['form_Artigo_Descrição'];
		$Img = $_POST['form_Artigo_img'];
		$IdDono = $_SESSION['IdDono'];
		$sql = "INSERT INTO Artigo (ID, Nome, AltImg, Descrição, Img, IdDono) VALUES ('$ID', '$ArtigoNome', '$AltImg', '$Descrição', '$Img', '$IdDono')";
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