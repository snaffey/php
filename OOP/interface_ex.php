<?php

interface ContaBancaria
{
    public function retirar($valor);
    public function depositar($valor);
}

class ContaPoupanca implements ContaBancaria
{
    private $valor;

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function retirar($valor)
    {
        $this->valor -= $valor;
    }

    public function depositar($valor)
    {
        $this->valor += $valor;
    }
}

$contaSergio = new ContaPoupanca();
$contaProg = new ContaPoupanca();

$contaSergio->setValor(1000);
$contaProg->setValor(10000000000000000000000);

echo "Valor da conta do Sergio: " . $contaSergio->getValor() . " euros <BR>";
echo "Valor da conta do Programador: " . $contaProg->getValor() . " euros <BR>";

$contaSergio->depositar(100);
$contaProg->retirar(10000000000);

echo "Valor da conta do Sergio: " . $contaSergio->getValor() . " euros <BR>";
echo "Valor da conta do Programador: " . $contaProg->getValor() . " euros <BR>";
