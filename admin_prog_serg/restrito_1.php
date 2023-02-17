<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Admin PaGE</title>
		<link rel="stylesheet" href="./css/estilo.css" >
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script src="./js/home.js">
		</script>
	</head>
	<body>
		<form action="validacao.php" method="post">
			<fieldset>
                <legend>Dados de Login</legend>
                <label for = "txUser">User</label>
                <input type = "text" name = "user" id = "txUser" maxlength = "25" />
                <label for = "txPassword">Password</label>
                <input type = "password" name = "password" id = "txPassword" />
                <input type = "submit" value = "Entrar" />
            </fieldset>
        </form>
    </body>
</html>
