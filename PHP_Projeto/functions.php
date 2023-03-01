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

    public function checkArtigo($ArtigoID)
    {
        $query = 'SELECT * FROM `Artigo` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
        $artigo = $this->ds->select($query, $paramType, $paramValue);
        if (empty($artigo)) {
            echo '<p class="form_error">Internal error: Artigo not exist </p>';
            return false;
        }
        return $artigo;
    }

    function get_artigo($ArtigoID) {
        $query = 'SELECT * FROM `Artigo` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
        $artigo = $this->ds->select($query, $paramType, $paramValue);
        if (empty($artigo)) {
            echo '<p class="form_error">Internal error: Artigo not exist </p>';
            return false;
        }
        return $artigo;
    }

    function get_artigo_details($ArtigoID) {
        $query = 'SELECT * FROM `ArtigoInfo` WHERE `ID`= ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
        $artigo = $this->ds->select($query, $paramType, $paramValue);
        if (empty($artigo)) {
            echo '<p class="form_error">Internal error: Artigo not exist - func </p>';
            return false;
        }
        return $artigo;
    }

    function validateForm($Artigo) {
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

    public function saveArtigo($ArtigoID)
    {
        $fetch_Artigo = $this->checkArtigo($ArtigoID);
        if (!$fetch_Artigo) {
            $this->insertArtigo();
            return;
        }
        $Artigo_ID = $fetch_Artigo[0]['ID'];
        if (!empty($Artigo_ID)) {
            $query = "UPDATE Artigo SET Nome='" . $_POST['form_Artigo_nome'] . "', AltImg = '" . $_POST['form_Artigo_alt'] . "', Descrição = '" . $_POST['form_Artigo_Descrição'] . "', Img = '" . $_POST['form_Artigo_img'] . "' WHERE ID =" . $Artigo_ID;
            $paramType = '';
            $paramValue = array();
            $this->ds->update($query, $paramType, $paramValue);
            echo '<p>Artigo successfully updated.</p>';
            header("Location: " . $_SERVER['PHP_SELF']);
            return;
        }
    }

    public function insertArtigo()
    {
        if (empty($_POST['form_Artigo_alt']) || empty($_POST['form_Artigo_Descrição']) || empty($_POST['form_Artigo_img']) || empty($_POST['form_Artigo_nome'])) {
            echo "One of the fields is empty";
            return;
        } else {
            $query = "SELECT MAX(ID) as max_id FROM Artigo";
            $paramType = '';
            $paramValue = array();
            $result = $this->ds->select($query, $paramType, $paramValue);
            if (!empty($result)) {
                $maxID = intval($result[0]['max_id']);
                $_POST["idArtigo"] = $maxID + 1;
            }
            $ID = $_POST['idArtigo'];
            $ArtigoNome = $_POST['form_Artigo_nome'];
            $AltImg = $_POST['form_Artigo_alt'];
            $Descrição = $_POST['form_Artigo_Descrição'];
            $Img = $_POST['form_Artigo_img'];
            $IdDono = $_SESSION['IdDono'];
            $query = "INSERT INTO Artigo (ID, Nome, AltImg, Descrição, Img, IdDono) VALUES (?, ?, ?, ?, ?, ?)";
            $paramType = 'issssi';
            $paramValue = array(
                $ID,
                $ArtigoNome,
                $AltImg,
                $Descrição,
                $Img,
                $IdDono
            );
            $this->ds->insert($query, $paramType, $paramValue);
            echo "New record created successfully";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}



