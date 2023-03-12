<?php
include_once './Departamento.php';

$e = new Empresa("Empresa X");
$novaEmpresa = new Empresa("Empresa Y");

$e->addDep("Departamento A");
$e->addDep("Departamento B");
$e->addDep("Departamento C");
$e->listaTodos();

$novaEmpresa->addDep("Departamento D");
$novaEmpresa->addDep("Departamento E");
$novaEmpresa->addDep("Departamento F");
$novaEmpresa->listaTodos();