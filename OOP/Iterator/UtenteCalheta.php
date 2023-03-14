<?php

include_once './AgregadoUtentes.php';
include_once './IteratorListaUtentesCalheta.php';

class UtentesCalheta implements AgregadoUtentes{
    protected $utentes;

    public function __construct() {
        $this->utentes = array();
        $this->utentes[] = new Utente("João");
        $this->utentes[] = new Utente("Maria");
        $this->utentes[] = new Utente("José");
        $this->utentes[] = new Utente("Ana");
    }

    public function criaIterador() {
        return new IteratorListaUtentesCalheta($this->utentes);
    }
}

?>