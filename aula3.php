<?php
    //modificador estatico(static)

    function testeSemRec()
    {
        $a = 0;
        echo $a;
        $a++;
    }
    function testeComRec()
    {
        static $a = 0;
        echo $a;
        if ($a < 20) {
            $a++;
            //testeComRec();
        }
    }
    //testeComRec();


    /*

    urlencode -> codifica segundo a tabela ASCII
    urldecode -> descodifica segundo a tabela ASCII

    /

    $url = "http://localhost/phpprog21/aula3.php";
    $encUrl = urlencode($url);
    //echo $encUrl.'<br />';

    $deUrl ="http%3A%2F%2Flocalhost%2Fphpprog21%2Faula3.php";
    $deEncUrl = urldecode($deUrl);
    //echo $deEncUrl.'<br />';

    //verificacao de tipos em funcao da var

    $b = 2;
    //echo gettype($b);

    if(gettype($b) == "integer")
        //echo "A var é inteira";

    //echo is_integer($b);

    // is_integer, is_string, is_double

    /
    verificar a existencia da criacao da variavel
    isset();
    */
    $a = "teste";
    $b = "outro teste";

    //var_dump(isset($a));
    //var_dump(isset($b));

    unset($a);//remover var da memoria
    //var_dump(isset($a));
    //var_dump(isset($a,$b));//basta uma nao existir que da false

    $transporte = array('a pé','bike','carro','avião');
    //pos atual
    $modo = current($transporte);
    //echo $modo.'<br />';
    //pos seguinte
    $modo = next($transporte);
    //echo $modo.'<br />';
    //pos anterior
    $modo = prev($transporte);
    //echo $modo.'<br />';
    //ultima pos
    $modo = end($transporte);
    //echo $modo.'<br />';

    //Ex
    echo current($transporte);
    while ($modo = next($transporte)) {
        echo $modo." ";
    }

    // in_array -> verifica se existe um valor no array, retorna true ou false
    $ar = array("Mac","NT","Win","Linux");
    $res = in_array("Mac", $ar);
    var_dump($res);
    if (in_array("Mac", $ar)) {
        echo "Existe".'<br />';
    }

    // array_search -> retorna a pos do valor no array
    $indice = array_search("NT", $ar);
    echo $indice.'<br />';

    // array_keys -> retorna as chaves do array
    print_r(array_keys($ar, "NT"));

    /* Métodos de controle de string */
    // explode -> ira dividir uma determinada string passada como argumento, criando um array com cada substring criada atraves do caracter de separação indicado
    echo '<br />------------ explode ------------<br />';
    $str = "O funchal é uma cidade muito bonita e hoje está sol";
    $separacao = explode(" ", $str);
    echo $separacao[3].'<br />';
    print_r($separacao).'<br />';

    $data = "cab:*:1023:1000::/home/cab:/bin/sh";
    list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
    echo $user.'<br />'; // cab
    echo $pass.'<br />'; // *

    // metodo implode -> ira juntar os elementos de um array, criando uma string com os elementos separados por um caracter de separação indicado
    echo '<br />------------ implode ------------<br />';
    $a = array('Sergio','30','Funchal');
    $str = implode("::", $a);
    echo $str.'<br />';

    // md5 -> ira retornar uma string com o valor criptografado em md5, 32 caracteres
    echo '<br />------------ md5 ------------<br />';
    $epcc = md5("epcc");
    echo $epcc.'<br />';

    if (md5("epcc") === $epcc) {
        echo "A palavra epcc é igual a $epcc".'<br />';
    } else {
        echo "A palavra epcc é diferente de $epcc".'<br />';
    }

    $str = chr(65);
    echo $str.'<br />';

    // strcasecmp -> ira comparar duas strings, ignorando a diferença entre maiusculas e minusculas
    echo '<br />------------ strcasecmp ------------<br />';
    $str1 = "epcc";
    $str2 = "EPCC";

    if (strcasecmp($str1, $str2) == 0) {
        echo "As strings são iguais".'<br />';
    } elseif (strcasecmp($str1, $str2) > 0) {
        echo "A string $str1 é maior que $str2".'<br />';
    } else {
        echo "A string $str1 é menor que $str2".'<br />';
    }

    ?>

<html>
    <head>
        <title>Aula 3</title>
    </head>
    <body>

    </body>
</html>