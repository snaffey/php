<?php   
//$_POST ou $_GET
if(isset($_POST['email']) && isset($_POST['info']))
    if (!empty($_POST['email'])) 
        echo "Email: ".$_POST['email']. " Info: ".$_POST['info'];

echo $_SERVER['HTTP_USER_AGENT'];
echo $_SERVER['SERVER_PORT'];
echo $_SERVER['REMOTE_METHOD'];
echo $_SERVER['PHP_SELF'];

$nextWeek = time() + (7 * 24 * 60 * 60);
echo 'Now:       '. date('Y-m-d')."\n";

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