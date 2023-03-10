<?
/*
Uma classe cria a instancia de outra classe no seu contexto, quando a classe todo for destruida, a outra classe tambem sera destruida
*/

class Pessoa{
    public function configura ($nome){
        return "Nome: " . $nome;
    }
}

class Mostrar{
    public $pessoa;
    public $nome;

    public function __construct($nome = null){
        $this->pessoa = new Pessoa();
        $this->nome = $nome;
    }

    public function exibe(){
       echo $this->pessoa->configura($this->nome);
    }
}

$mostrar = new Mostrar("Joao");
$mostrar->exibe();
