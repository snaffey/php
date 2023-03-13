<?php

include_once './AgregadoUtentes.php';

class UtentesCalheta implements AgregadoUtentes{
    protected $utentes;

    public function __construct() {
        $this->utentes = array();
        $this->utentes[] = new Utente("João", "Calheta");
        $this->utentes[] = new Utente("Maria", "Calheta");
        $this->utentes[] = new Utente("José", "Calheta");
        $this->utentes[] = new Utente("Ana", "Calheta");
    }
}

?>