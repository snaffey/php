<?php
namespace Phppot;

class FuncDestaque
{
    
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->ds = new DataSource();
    }

    public function listDestaque()
    {
        $query = 'SELECT * FROM `Destaque` ORDER BY ID ASC';
        $paramType = '';
        $paramValue = array();
        $artigos = $this->ds->select($query, $paramType, $paramValue);
        return $artigos;
    }

    public function delDestaque($Destaque)
    {
        $query = 'DELETE FROM `Destaque` WHERE `Destaque` = ?';
        $paramType = 'i';
        $paramValue = array(
            $Destaque
        );
        $this->ds->execute($query, $paramType, $paramValue);

        header("Location: " . $_SERVER['PHP_SELF']);

    }

    // check user
    public function checkDestaque($Destaque)
    {
        $query = 'SELECT * FROM `Destaque` WHERE `Destaque` = ?';
        $paramType = 'i';
        $paramValue = array(
            $Destaque
        );
        $user = $this->ds->select($query, $paramType, $paramValue);
        if (empty($user)) {
            echo '<p class="form_error">Internal error: Destaque not exist </p>';
            return false;
        }
        return $user;
    }
    
    public function saveDestaque($Destaque)
    {
        $fetch_dest = $this->checkDestaque($Destaque);

        if (!$fetch_dest) {
            $this->insertDestaque();
            return;
        }

        $Destaque = $fetch_dest[0]['Destaque'];
        print_r($Destaque);
        if (!empty($Destaque)) {
            $query = "UPDATE Destaque SET Destaque='" . $_POST['form_user_destaque'] . "' WHERE Destaque='" . $Destaque . "'";
            $paramType = '';
            $paramValue = array();
            $this->ds->update($query, $paramType, $paramValue);
            echo '<p>user successfully updated.</p>';
            header("Location: " . $_SERVER['PHP_SELF']);
            return;
        }
    }

    public function insertDestaque()
    {
        $query = "INSERT INTO Destaque (Destaque) VALUES (?)";
        $paramType = 's';
        $paramValue = array(
            $_POST['form_user_destaque']
        );
        $this->ds->insert($query, $paramType, $paramValue);
        echo '<p>Destaque successfully added.</p>';
        header("Location: " . $_SERVER['PHP_SELF']);
    }

}