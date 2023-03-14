<?php

namespace Phppot;

class FuncDono
{
    private $ds;

    public function __construct()
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

    // check user
    public function checkUser($UserID)
    {
        $query = 'SELECT * FROM `User` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $UserID
        );
        $user = $this->ds->select($query, $paramType, $paramValue);
        if (empty($user)) {
            echo '<p class="form_error">Internal error: User not exist </p>';
            print_r($user);
            return false;
        }
        return $user;
    }

    public function saveUser($UserID)
    {
        $fetch_user = $this->checkUser($UserID);
        $UserID = $fetch_user[0]['id'];
        print_r($UserID);
        if (!empty($UserID)) {
            $query = "UPDATE User SET username='" . $_POST['form_user_username'] . "', Nivel='" . $_POST['form_user_nivel'] . "' WHERE ID='" . $UserID . "'";
            $paramType = '';
            $paramValue = array();
            $this->ds->update($query, $paramType, $paramValue);
            echo '<p>user successfully updated.</p>';
            header("Location: " . $_SERVER['PHP_SELF']);
            return;
        }
    }
}
