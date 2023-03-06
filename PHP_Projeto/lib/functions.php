<?php
namespace Phppot;

class Func 
{
    
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
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

    public function listArtigosDono($Id)
    {
        $query = 'SELECT * FROM `Artigo` WHERE `IdDono` = ? ORDER BY ID ASC';
        $paramType = 'i';
        $paramValue = array($Id);
        $artigos = $this->ds->select($query, $paramType, $paramValue);
        return $artigos;
    }

    public function listUtilizadoresDono()
    {
        $query = 'SELECT * FROM `User` ORDER BY ID ASC';
        $paramType = '';
        $paramValue = array();
        $users = $this->ds->select($query, $paramType, $paramValue);
        return $users;
    }

    // delete user
    public function delUser($UserID)
    {
        $query = 'DELETE FROM `User` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $UserID
        );
        $this->ds->execute($query, $paramType, $paramValue);

        header("Location: " . $_SERVER['PHP_SELF']);

    }

    public function delArtigo($ArtigoID)
    {
        // Get the path to the image
        $query = 'SELECT `Img` FROM `Artigo` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $ArtigoID
        );
        $result = $this->ds->select($query, $paramType, $paramValue);
        if (!empty($result)) {
            $imgPath = $result[0]['Img'];
            
            // Delete the record from the database
            $query = 'DELETE FROM `Artigo` WHERE `ID` = ?';
            $paramType = 'i';
            $paramValue = array(
                $ArtigoID
            );
            $this->ds->execute($query, $paramType, $paramValue);
    
            // Delete the file from the server
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
    
        // Refresh the page to update the article list
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

    public function getArtigosDestaque()
    {
        $query = 'SELECT ID, Img, AltImg FROM `Artigo` WHERE `ID` IN (SELECT `Destaque` FROM `Destaque`)';
        $paramType = '';
        $paramValue = array();
        $destaques = $this->ds->select($query, $paramType, $paramValue);

        if (empty($destaques)) {
            throw new Exception('Ocorreu um erro ao obter os destaques');
        }

        return $destaques;
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
    $ArtigoImg = '';
    if (empty($_POST['form_Artigo_alt']) || empty($_POST['form_Artigo_Descrição']) || empty($_POST['form_Artigo_nome'])) {
        echo "One of the fields is empty";
        return;
    } elseif (isset($_FILES['form_Artigo_img']) && $_FILES['form_Artigo_img']['error'] == UPLOAD_ERR_OK) {
        $upOne = dirname(__DIR__, 1);
        $uploadDir = $upOne . '/img/';
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 1024 * 1024; // 1 MB
        $imgName = basename($_FILES['form_Artigo_img']['name']);
        $imgPath = $uploadDir . uniqid() . '-' . $imgName;
        $imgType = $_FILES['form_Artigo_img']['type'];
        $imgSize = $_FILES['form_Artigo_img']['size'];

        // Validate file type and size
        if (in_array($imgType, $allowedTypes) && $imgSize <= $maxSize) {
            // Move uploaded file to safe location
            move_uploaded_file($_FILES['form_Artigo_img']['tmp_name'], $imgPath);
            $ArtigoImg = $imgPath;
        } else {
            echo "Error: invalid file type or size";
            return;
        }
    }

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
    $Img = $ArtigoImg;
    $IdDono = $_SESSION['Id'];
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

public function insertMensagem()
{
    // Check if the required form fields are not empty
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['assunto']) || empty($_POST['mensagem'])) {
        echo "One of the fields is empty";
        return;
    }

    $query = "SELECT MAX(ID) as max_id FROM Mensagens";
    $paramType = '';
    $paramValue = array();
    $result = $this->ds->select($query, $paramType, $paramValue);
    if (!empty($result)) {
        $maxID = intval($result[0]['max_id']);
        $_POST["idMensagem"] = $maxID + 1;
    }

    $query = "INSERT INTO Mensagens (Id, Nome, Email, Assunto, Mensagem) VALUES (?, ?, ?, ?, ?)";
    $paramType = 'issss';
    $paramValue = array(
        $_POST['idMensagem'],
        $_POST['nome'],
        $_POST['email'],
        $_POST['assunto'],
        $_POST['mensagem']
    );
    $this->ds->insert($query, $paramType, $paramValue);
    echo "New message created successfully";
    header("Refresh:1 ; url= index.php");
    exit;
}

    
}



