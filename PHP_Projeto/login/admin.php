<?php
session_start();

if (!isset($_SESSION["username"])) {
    session_unset();
    session_write_close();
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION["username"];
$Id = $_SESSION["Id"];

session_write_close();

$upOne = dirname(__DIR__, 1);
require_once $upOne . '/lib/calls.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="assets/css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="phppot-container">
        <div class="page-header">
            <span class="login-signup"><a href="logout.php">Logout</a></span>
        </div>
        <div class="page-content">Welcome <?php echo htmlspecialchars($username)?></div>
        <div class="page-content">Id: <?php echo htmlspecialchars($Id)?></div>
    </div>
<form action="" method="post" enctype="multipart/form-data">
    <table class="form-table">
        <tr>
            <td>Nome:</td>
            <td>
                <input type="text" name="form_Artigo_nome" value="<?php
                if (isset($ArtigoNome)) {
                    echo htmlspecialchars($ArtigoNome);
                } ?>">
            </td>
        </tr>
        <tr>
            <td>Valor:</td>
            <td>
                <input type="text" name="form_Artigo_valor" value="<?php
                if (isset($ArtigoValor)) {
                    echo htmlspecialchars($ArtigoValor);
                } ?>">
            </td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td>
                <input type="text" name="form_Artigo_Descrição" value="<?php
                if (isset($ArtigoDesc)) {
                    echo htmlspecialchars($ArtigoDesc);
                } ?>">
            </td>
        </tr>
        <tr>
            <td>Img:</td>
            <td> 
                <input type="file" name="form_Artigo_img">
                <?php
                    if (!empty($ArtigoImg)) {
                        echo '<img src="' . htmlspecialchars($ArtigoImg) . '">';
                    }
?>
            </td>
        </tr>
        <tr>
            <td>Alt Img:</td>
            <td>
                <input type="text" name="form_Artigo_alt" value="<?php
if (isset($AltImg)) {
    echo htmlspecialchars($AltImg);
} ?>">
            </td>
        </tr>
        
        
        <tr>
            <td colspan="2">
                <input type="hidden" name="save" value="<?php echo htmlspecialchars($ArtigoID); ?>">
                <input type="submit" value="Save">
            </td>
        </tr>
    </table>
</form>

<?php
$lista = $artigo_list_dono;
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Img</th>
            <th>Alt Img</th>
            <th>Edição</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($lista) || is_object($lista)) {
            foreach ($lista as $Artigo): ?>
        <tr>
            <td><?php echo htmlspecialchars($Artigo['ID']); ?></td>
            <td><?php echo htmlspecialchars($Artigo['Nome']); ?></td>
            <td><?php echo htmlspecialchars($Artigo['Valor']); ?></td>
            <td><?php echo htmlspecialchars($Artigo['Descrição']); ?></td>
            <td><?php echo htmlspecialchars($Artigo['Img']); ?></td>
            <td><?php echo htmlspecialchars($Artigo['AltImg']); ?></td>
            <td>
                <?php
                $url = htmlspecialchars($_SERVER['PHP_SELF']);
                ?>
                <form method="post" action="<?php echo $url; ?>">
                    <input type="hidden" name="edit" value="<?php echo htmlspecialchars($Artigo['ID']); ?>">
                    <input type="submit" name="submit" value="Edit">
                </form>
                <a href="<?php echo htmlspecialchars(HOME_URI); ?>?del=<?php echo htmlspecialchars($Artigo['ID']); ?>" onclick="return confirm('Are you sure you want to delete this article?')">Del</a>
                <a href="<?php echo htmlspecialchars(GALERIA); ?>?ID=<?php echo htmlspecialchars($Artigo['ID']); ?>">Imgs</a>
            </td>
        </tr>
        <?php endforeach;
        } else {
            echo "No items were found, try adding some!";
        }
?>
    </tbody>
</table>
</body>
</html>