<?php
//$_POST ou $_GET
/*
if(isset($_POST['email']) && isset($_POST['info']))
    if (!empty($_POST['email'])) 
        echo "Email: ".$_POST['email']. " Info: ".$_POST['info'];
*/
/*
echo $_SERVER['HTTP_USER_AGENT'];
echo $_SERVER['SERVER_PORT'];
echo $_SERVER['REMOTE_METHOD'];
echo $_SERVER['PHP_SELF'];
*/
/*
$nextWeek = time() + (7 * 24 * 60 * 60);
echo 'Now:'. date('Y-m-d')."\n";
echo 'Next Week:'. date('Y-m-d', $nextWeek)."\n";
$hora = date('H:i:s');
echo $hora;
*/
/*
if (isset($_POST['submit'])) {
    red();
}

function red() {
    $host = $_SERVER['HTTP_HOST'];
    echo $host.'<br>';
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    echo $uri.'<br>';
    $extra = 'aula4.php';
    header("Location: http://$host$uri/$extra");
}

*/
//setcookie('nome', 'valor', time()+3600);

setcookie ("cookie3", "cookiethree");
setcookie ("cookie2", "cookietwo");
setcookie ("cookie1", "cookieone");

/*
if (isset($_COOKIE)){
    print_r($_COOKIE);
}*/

/* echo $_COOKIE["cookie2"];*/

$umDia = time() + 86400;
setcookie ("NOMEUSER", "Joao", $umDia);

?>
<html>
    <head>
        <title>Aula 5 -FILES</title>
    </head>
    <body>
        <form name="form1" method="post" action="">
            Texto<input type="text" name="texto" value="">
            Info<input type="text" name="info" value="">
            Email<input type="text" name="email" value="">
            Submit<input type="submit" name="submit" value="Enviar!">
        </form> 
    </body>
</html>