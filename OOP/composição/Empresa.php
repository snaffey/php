<?php
include_once './Departamento.php';

class Empresa
{
    private $nome;
    private $deps;
    private static $numMaxDeps = 10;
    private $numProxDep = 0;

    public function __construct($n)
    {
        $this->nome = $n;
        $this->deps[] = array(self::$numMaxDeps);
        echo "Empresa {$this->nome} criada com sucesso!<br>";
    }

    public function addDep($d)
    {
        if ($this->numProxDep < self::$numMaxDeps) {
            $this->deps[$this->numProxDep] = new Departamento($this, $d);
            $this->numProxDep++;
        } else {
            echo "Número máximo de departamentos atingido!<br>";
        }
    }

    public function listaTodos()
    {
        echo "Empresa {$this->nome} possui os seguintes departamentos:<br>";
        if ($this->deps != null) {
            foreach ($this->deps as $dep) {
                if ($dep != null) {
                    echo $dep->getNomeDepartamento() . "<br>";
                }
            }
            echo "********Fim da lista********<br>";
        } else {
            echo "Nenhum departamento cadastrado!<br>";
        }
    }
}
?>