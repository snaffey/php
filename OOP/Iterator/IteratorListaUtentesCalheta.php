<?php
include_once 'IteratorInterface.php';

class IteratorListaUtentesCalheta implements IteratorInterface {
    protected $lista = array();
    protected $contador;

    public function __construct($lista) {
        $this->lista = $lista;
        $this->contador = 0;
    }

    public function first() {
        $this->contador = 0;
    }

    public function next() {
        $this->contador++;
    }

    public function isDone() {
        return $this->contador >= count($this->lista);
    }

    public function currentItem() {
        if ($this->isDone()) {
            $this->contador = count($this->lista) - 1;
        } elseif ($this->contador < 0) {
            $this->contador = 0;
        }
        
    }
}

?>