<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>My Page</title>
        <link rel="stylesheet" href="css/home.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/home.js"></script>
    </head>

    <body>
        <form action="validacao.php" method="post">
            <fieldset>
                <legend>Dados de login</legend>
                <label for="txUser">Usuário:</label>
                <input type="text" name="User" id="txUser" maxlength="25" />
                <label for="txPassword">Senha:</label>
                <input type="password" name="Password" id="txPassword" />
                <input type="submit" value="Entrar" />
            </fieldset>
        </form>
    </body>
</html>