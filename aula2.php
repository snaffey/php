<?php
    function imprimeTxt($txt){
        echo 'Txt ->'.$txt.'<br>';
    }

    imprimeTxt("Ola via function");
    imprimeTxt(12);

    function soma($n) {
        $n += 20; // n = n + 20
    }

    $a = 3;
    soma($a);
    imprimeTxt($a);
    //imprimeTxt($n);

    function somaR($n1, $n2){
        $n1 += 10;
        $n2 += 10;
    }

    $z = $t = 1;
    somaR($z, $t);
    imprimeTxt($z);
    imprimeTxt($t);

    // função com valores pre-def.

    function teste($i, $n = 'Sergio'){
        echo 'Nome '.$n.' Idade '.$i.'<br>';
    }
    teste(12, 'Ana');
    teste(33);

    // função primitiva
    $func = function($n) {
        echo 'Ola via function primitiva '.$n.'<br>';
    };
    $func("Tiago");

    // escopo, isto é dimen. da var
    $escopo = "TESTEESCOPO"; // var global
    function escopo(){
        global $escopo;
        echo $escopo;
    }
    escopo();

    // escopo em funções
    function pai(){
        function filho(){
            echo 'Filho';
        }
        echo 'Pai';
    }
    pai();
    filho();

    function mult($a,$b){
        return $a * $b;
    }

    $res = mult(2,3);
    imprimeTxt($res);

    // Criar listas de var via array

    $info = array('Sergio', 12, 'Rua 1');
    list($nome, $idade, $morada) = $info;
    imprimeTxt($nome);
    imprimeTxt($idade);
    imprimeTxt($morada);

    function nL() {
         return [12,13,15];
    }

    list($a, $b, $c) = nL();
    imprimeTxt($a);
    imprimeTxt($b);
    imprimeTxt($c);

?>

<html>
    <head>
        <title>Aula 2</title>
    </head>
    <body>

    </body>
</html>