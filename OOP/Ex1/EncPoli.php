<?php

class Pessoa{
    private $id;
    protected $nome;

    public function setid ($id_p){
        $this->id = $id_p;
    }

    public function getid (){
        return $this->id;
    }

    public function setnome ($nome_p){
        $this->nome = $nome_p;
    }

    public function getnome (){
        return $this->nome;
    }
}

class PessoaFisica extends Pessoa{
}

$pessoa = new Pessoa();
$pessoaFisica = new PessoaFisica();
/*
 * Privado não pode ser alteado diretamente
 * $pessoa->id = 1;
 * $pessoaFisica->id = 1; 
 */
$pessoa->setid(1);
$pessoaFisica->setid(12);

class Veiculo{
    public $andar;
    protected $qtRodas;
    public function setQtRodas ($qtRodas){
        $this->qtRodas = $qtRodas;
        echo "<br />";
    }

    public function getQtRodas (){
        return $this->qtRodas;
    }

    public function andar(){
        echo 'Andando...';
        echo '<br />';
    }

    public function porGasolina(){
        echo 'Por Gasolina...';
        echo '<br />';
    }
}

class Carro extends Veiculo{
    public function __construct(){
        $this->setQtRodas(4);
    }
}

class Moto extends Veiculo{
    public function __construct(){
        $this->setQtRodas(2);
    }
}

$carro = new Carro();
$carro->porGasolina();
$carro->andar();
echo $carro->getQtRodas();

$moto = new Moto();
$moto->porGasolina();
$moto->andar();
echo $moto->getQtRodas();

class CarroComum{
    protected $valor;
    public function setValor ($valor){
        $this->valor = $valor;
    }

    public function getValor (){
        return $this->valor;
    }

    public function calcularImposto(){
        return $this->valor * 1.22;
    }
};

class CarroLuxo extends CarroComum{
    public function calcularImposto(){
        return $this->valor * 1.56;
    }
};

$carroComum = new CarroComum();
$carroComum->setValor(10000);
echo $carroComum->calcularImposto();
echo"<br />";

$carroLuxo = new CarroLuxo();
$carroLuxo->setValor(10000);
echo $carroLuxo->calcularImposto();


?>