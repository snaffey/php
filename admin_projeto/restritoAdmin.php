<?
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['UserID'])) {
    session_destroy();
    //header("Location: index.php"); exit;
}

include_once("./functiondb.php");
?>


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

        <h3>Pagina restrita: <?php echo $_SESSION['UserNome']; 
        echo "<br/><a href='logout.php'>Sair</a>"
        ?></h3>
        <form action="" method="post">
            <table class ="form-table">
                <tr>
                    <td>Nome:</td>
                    <td><input type="text" name="nome"/></td>
                </tr>
                <tr>
                    <td>Descricao:</td>
                    <td><input type="text" name="descricao"/></td>
                </tr>
                <tr>
                    <td>Img Path:</td>
                    <td><input type="text" name="img_path"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Inserir" name="inserir"/>
                    </td>
                </tr>
        </form>
    </body>
</html>