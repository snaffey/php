<?php
include_once './Empresa.php';
class Departamento
{
    protected $nomeDepartamento;
    public Empresa $empresa;

    public function __construct(Empresa $e, $d)
    {
        $this->empresa = $e;
        $this->nomeDepartamento = $d;
    }
    public function getNomeDepartamento()
    {
        return $this->nomeDepartamento;
    }
}