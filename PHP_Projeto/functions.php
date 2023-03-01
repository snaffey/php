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

        header("Location: " . $_SERVER['PHP_SELF']);

    }

    public function getArtigoDetails($ArtigoID)
    {
        $query = 'SELECT * FROM `ArtigoInfo` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
        $artigoInfo = $this->ds->select($query, $paramType, $paramValue);
        return $artigoInfo;
    }

    /* Do the same as the others
    function get_Artigo($ArtigoID) {
	global $connection;
	$sql = "SELECT * FROM `Artigo` WHERE `ID`= $ArtigoID";
	 $query = mysqli_query($connection, $sql);
	 if (mysqli_num_rows($query) > 0) {
		 return mysqli_fetch_assoc($query);
	 }else
		exit;
    }
    */
    public function getArtigo($ArtigoID) {
        $query = 'SELECT * FROM `Artigo` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
    
        $artigo = $this->ds->select($query, $paramType, $paramValue);
        
    }
    

    public function validateForm($Artigo)
    {
        if (empty($Artigo)) {
            echo 'Artigo não encontrado';
            return false;
        }
        return true;
    }



    public function insertArtigo()
    {
        $query = "INSERT INTO Artigo (IdDono, Nome, AltImg, Descrição, Img) VALUES ( ?, ?, ?, ?, ?)";
        $paramType = 'issss';
        $paramValue = array(
            $_SESSION['IdDono'],
            $_POST['form_Artigo_nome'],
            $_POST['form_Artigo_alt'],
            $_POST['form_Artigo_Descrição'],
            $_POST['form_Artigo_img']
        );
        $this->ds->execute($query, $paramType, $paramValue);
    }

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
        $fetch_Artigo = $this->checkArtigo($ArtigoID);
        
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



