<?php
    // isto é um comentário
    /*
        var -> tipos primitivos
        Inteiro
        Decimal
        String
        Arrays
        Objetos
        Sintaxe $nomedavar = atribuição
        NOTA -> Não é necessário declarar o tipo da variável
    */
    $numero = 12;
    echo "O número é ".$numero."<br>";
    $numero = "Sergio"."<br>";
    echo $numero;
    $a = -123;
    echo "a -> ".$a."<br>";
    $c = 0234;
    echo "c -> ".$c."<br>";
    // 0x -> hexadecimal
    $d = 0x1A;
    echo "d -> ".$d."<br>";
    // 23e4 -> 23 * 10^4
    $e = 23e4;
    echo "e -> ".$e."<br>";

    // aspa simples( ' ) -> não interpreta variáveis
    // aspa dupla( " ) -> interpreta variáveis
    echo 'O número é $numero'."<br>";
    echo "O número é $numero<br>";

    // Arrays simples, são dinâmicos em valor e índice
    $cor[1] = "vermelho";
    $cor[2] = "azul";
    $cor[3] = "verde";
    $cor[4] = "amarelo";
    $cor["teste"] = 12;
    print_r($cor);
    echo "1 do array cor -> ".$cor[1]."<br>";

    // Exemplo 2
    $ar = array();
    $ar[] = "PHP";
    $ar[] = "Java";
    $ar[] = "C#";
    $ar[] = "C++";
    print_r($ar);

    // Exemplo 3
    $ar2 = array(12, 23, 34, 45, 56);
    print_r($ar2);

    // Exemplo 4
    $ar3 = array(0 => 12, 2 => 3, 10 => "item 10");
    print_r($ar3);

    // mult dim.
    $pessoas = array(array('nome' => 'Sergio', 'salario' => 1000),
                     array('nome' => 'João', 'salario' => 2000),
                     array('nome' => 'Maria', 'salario' => 3000));
    print_r($pessoas);

    // transf. explicita de tipo
    $a = 12;
    echo "Tipo -> ".gettype($a)."<br>";
    $a = (double)$a;
    echo "Tipo -> ".gettype($a)."<br>";
    $a = 3.9;
    $a = (int)$a;
    echo "Tipo -> ".gettype($a)."<br>";
    echo "Valor -> ".$a."<br>";
    define("PI", 3.14);
    $raio = 4;
    $c = 2*PI*$raio;
    echo "Circunferência -> ".$c."<br>";

    // Unarios
    $a = 12;
    $a += 10; // $a = $a + 10;
    echo "a -> ".$a."<br>";

    $b = 12;
    $b = ++$b; // $b = $b + 1;
    echo "b -> ".$b."<br>";

    /* Logicos
        && -> and
        || -> or
        ^ -> xor
        ! -> not
    */
    
    $res = (12 > 11) && (1 == 3);
    echo "res -> ".$res."<br>";
    var_dump($res); // mostra o tipo e o valor

    //Relacionais <; >; <=; >=; ==; !=; ===; !==
    $teste = ($b > 10) ? "Superior a 10" : 13;
    echo "teste -> ".$teste."<br>";

    /*
    maior
    - ! ++ --
    * / %
    + - .
    > < >= <=
    == != <>
    &&
    ||
    = += -= *= /= %=
    AND
    XOR
    OR
    menor
    */

    $valor = 12;
    if ($valor == 12) {
        echo "Valor igual a 12<br>";
        $valor = $b;
    } else if ($b < 20) {
        echo "Meno que 20<br>";
        $valor = $b;
    } else {
        echo "Valor diferente de 12<br>";
        $valor = $b;
    }

    $i = 1;
    switch ($i) {
        case 0:
            echo "0";
            break;
        case 1:
            echo "1";
            break;
        case 2:
            echo "2";
            break;
        default:
            echo "default";
    }

    // while
    $i = 1;
    while ($i <= 10) {
        echo $i."<br>";
        $i++;
    }

    $do = 1;
    do {
        echo $do."<br>";
        $do++;
    } while ($do <= 10);

    for ($i = 0; $i <= 20; $i++) {
        echo "->".$i."<br>";
    }

    // Break
    $x = 11;
    while ($x++ > 10){
        if ($x == 20) {
            echo "20"."<br>";
            break;
        }
        //echo $x."<br>";
    }

    $y = 0;
    for ( ; ; ){
        if ($y == 10) {
            break;
            echo $y++;
        }
    }

    /*
    for ($i = 0; $j = 0;
        $i < 10;
        $j+=$i,
        print "i -> ".$i." j -> ".$j."<br>", $i++);
    */
    
    $arr = array(1, 2, 3, 4);
    // foreach
    foreach ($arr as $value){
        echo $value."<br>";
    }

    //foreach por referencia
    foreach ($arr as &$value){
        $value = $value * 2;
    }

    print_r($arr);

    $arr2 = array(1, 2, 3, 4);
    foreach ($variable as $chave => $value) {
        echo "Chave -> ".$chave." Valor -> ".$value."<br>";
    }

    $av = array();
    $av [0] [0] = "a";
    $av [0] [1] = "b";
    $av [1] [0] = "c";
    $av [1] [1] = "d";
    $av [1] [2] = "e";
    foreach ($av as $linha)
        foreach ($linha as $coluna)
            echo $coluna."<br>";

    // Mesma coisa em for
    // count - conta o numero de elementos de um array
    for ($i = 0; $i < count($av); $i++){
        for ($j = 0; $j < count($av[$i]); $j++){
            echo $av[$i][$j]."<br>";
        }
    }
?>

<html>

    <head>
        <title>Exemplo de PHP</title>
    </head>

    <body>
        <?php
            echo"<p>Olá Mundo!</p>";
        ?>
    </body>

</html>