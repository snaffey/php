<?php

namespace Phppot;

class FuncMsg
{
    private $ds;

    public function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->ds = new DataSource();
    }

    public function listMsg()
    {
        $query = 'SELECT * FROM `Mensagens` ORDER BY ID ASC';
        $paramType = '';
        $paramValue = array();
        $mensagens = $this->ds->select($query, $paramType, $paramValue);
        return $mensagens;
    }

    public function delMsg($MsgID)
    {
        $query = 'DELETE FROM `Mensagens` WHERE `ID` = ?';
        $paramType = 'i';
        $paramValue = array(
            $MsgID
        );
        $this->ds->execute($query, $paramType, $paramValue);

        header("Location: " . $_SERVER['PHP_SELF']);
    }
}
