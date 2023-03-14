<?php

include_once 'carro_classe.php';

$um_carro = new Carro();
$dois_carro = new Carro();
$tres_carro = new Carro();

$um_carro->setAtributos('Mercedes', 'AMG', 'Azul');
$dois_carro->setAtributos('BMW', 'M3', 'Preto');
$tres_carro->setAtributos('Ferrari', 'F40', 'Vermelho');

echo "<hr />";
echo "<p>";
echo $um_carro->getAtributos();
echo "<br />";
echo $dois_carro->getAtributos();
echo "<br />";
echo $tres_carro->getAtributos();
echo "</p>";
echo "<hr />";
