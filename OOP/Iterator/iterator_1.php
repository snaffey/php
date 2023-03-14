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

interface IIterator{
    function hasNext();
    function next();
}

class ImovelIterator implements IIterator {
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
    public function next() {
        return $this->itens[$this->posicao++];
    }
}

//Main
$imoveisItens = array();
$imoveisItens[] = new ImovelItem('Casa');
$imoveisItens[] = new ImovelItem('Apartamento');

$it = new ImovelIterator($imoveisItens);
while ($it->hasNext()) {
    $imovel = $it->next();
    echo $imovel->_toString() . '<br>';
}

?>