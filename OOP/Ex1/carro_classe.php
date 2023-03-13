<?php
class Carro{
    private $_marca;
    private $_modelo;
    private $_cor;
    public function __construct(){
        echo 'Fui instanciado, logo que o obj foi criado <br />';
        $this->setAtributos(null, null, null);
    }

    public function __destruct(){
        echo 'Obj foi destruído <br />';
    }

    public function setAtributos($marca_p, $modelo_p, $cor_p){
        $this->_marca = $marca_p;
        $this->_modelo = $modelo_p;
        $this->_cor = $cor_p;
    }

    public function getAtributos(){
        return 'Marca: '.$this->_marca.'<br />Modelo: '.$this->_modelo.'<br />Cor: '.$this->_cor.'<br />';
    }

    public function getMarca(){
        return $this->_marca;
    }

    public function setMarca($marca_p){
        $this->_marca = $marca_p;
    }

    public function getModelo(){
        return $this->_modelo;
    }

    public function setModelo($modelo_p){
        $this->_modelo = $modelo_p;
    }

    public function getCor(){
        return $this->_cor;
    }

    public function setCor($cor_p){
        $this->_cor = $cor_p;
    }

}
?>