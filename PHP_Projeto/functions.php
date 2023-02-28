<?php
namespace Phppot;

class Func 
{
    
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/login/lib/DataSource.php';
        $this->ds = new DataSource();
    }

    public function listArtigos()
    {
        $query = 'SELECT * FROM `Artigo` ORDER BY ID ASC';
        $paramType = '';
        $paramValue = array();
        $artigos = $this->ds->select($query, $paramType, $paramValue);
        return $artigos;
    }

    public function delArtigo($ArtigoID)
    {
        $query = 'DELETE FROM `Artigo` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
        $this->ds->execute($query, $paramType, $paramValue);
    }

    /* Faz o mesmo que os outros
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
}*/

    public function checkArtigo($ArtigoID)
    {
        $query = "SELECT * FROM `Artigo` WHERE `ID` ='$ArtigoID'";
        $paramType = '';
        $paramValue = array();
        $artigo = $this->ds->select($query, $paramType, $paramValue);
        if (!$artigo) {
            echo '<p class="form_error">Internal error: Artigo not exist </p>';
            return false;
        }
        return $artigo;
    }

    public function saveArtigo($ArtigoID)
    {
        $fetch_Artigo = checkArtigo($ArtigoID);
        if (!$fetch_Artigo) {
            insertArtigo();
            return;
        }
        $Artigo_ID = $fetch_Artigo['ID'];
        if (!empty($Artigo_ID)) {
            $query = "UPDATE Artigo SET Nome='" . $_POST['form_Artigo_nome'] . "', AltImg = '" . 
            $_POST['form_Artigo_alt']."', Descrição = '" .$_POST['form_Artigo_Descrição'].
            "', Img = '". $_POST['form_Artigo_img']."' WHERE ID =" . $Artigo_ID;
            $paramType = '';
            $paramValue = array();
            $this->ds->execute($query, $paramType, $paramValue);
        }
    }

}



