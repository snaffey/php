<?php
if (!isset($_SESSION)) {
    session_start();
}
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
                    <td>Alt Img</td>
                    <td><input type="text" name="form_imovel_alt" value="<?php if(isset($altImg)) {
                        echo htmlentities($altImg);
                    } ?>" /></td>
                </tr>
                <tr>
                    <td>Descricao:</td>
                    <td><input type="text" name="descricao" value="<?php if(isset($imoveldescricao)) {
                        echo htmlentities($imoveldescricao);
                    } ?>" /></td>
                </tr>
                <tr>
                    <td>Img Path:</td>
                    <td><input type="text" name="img_path" value="<?php if(isset($imovelImg)) {
                        echo htmlentities($imovelImg);
                    } ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="save" value="<?= $imovelID ?>" />
                        <input type="submit" value="Inserir" name="inserir"/>
                    </td>
                </tr>
        </form>
        <?php
        $lista = get_imoveis_list();
?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alt</th>
                    <th>Descrição</th>
                    <th>Img</th>
                    <th>Edição</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lista as $imovel): ?>
                <tr>
                    <td><?=$imovel['id'] ?></td>
                    <td><?=$imovel['altimg'] ?></td>
                    <td><?=$imovel['descricao'] ?></td>
                    <td><?=$imovel['imgPath'] ?></td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="id" value="<?=$imovel['id'] ?>" />
                            <input type="submit" name="editar" value="Editar" />
                        </form>
                        <a href="<?= HOME_URL; ?>?del=<?=$imovel['id'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>