<?php

class ImovelItem {
    protected $nome;
    public function __construct($nome) {
        $this->nome = $nome;
    }
    public function _toString() {
        return $this->nome;
    }
}

interface Iterator{
    function hasNext();
    function next();
}

class ImovelIterator implements Iterator {
    protected $itens = array();
    protected $posicao = 0;
    public function __construct($itens) {
        $this->itens = $itens;
    }
    public function hasNext() {
        if ($this->posicao >= count($this->itens) || $this->itens[$this->posicao] == null) {
            return false;
        } else {
            return true;
        }
    }

}

?>