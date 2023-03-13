<?php
include_once 'IteratorInterface.php';

class IteratorListaUtentesCalheta implements IteratorInterface {
    protected $lista = array();
    protected $contador;

    public function __construct($lista) {
        $this->lista = $lista;
        $this->contador = 0;
    }
}

?>