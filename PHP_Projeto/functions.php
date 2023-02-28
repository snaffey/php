<?php
namespace Phppot;

if (isset($_POST['edit'])) {
    $Artigo = checkArtigo($_POST['edit']);
    valIDateForm($Artigo);
  }

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

}



