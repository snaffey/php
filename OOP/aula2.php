<?php

/* Relação simples entre objetos, um objeto usa outro objeto sem existir dependencia entre eles */

class Pai
{
    public $nome;
    public $filho;

    public function __construct($nome = null, $filho = null)
    {
        $this->nome = $nome;
        $this->filho = $filho;
    }
}

class Mae
{
    public $nome;

    public function __construct($nome = null)
    {
        $this->nome = $nome;
    }
}

class Filho
{
    public $nome;

    public function __construct($nome = null)
    {
        $this->nome = $nome;
    }
}

$mae = new Mae("Maria");
$filho = new filho("Manuel");
$pai = new Pai("Joao", $filho);

echo 'Familia: ' . $pai->nome . ' e ' . $mae->nome . ' tem um filho chamado ' . $pai->filho->nome . '.';
