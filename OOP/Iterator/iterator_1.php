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

}

?>