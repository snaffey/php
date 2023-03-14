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
require_once $upOne . '/lib/callsDono.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="assets/css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="menu">
        <a href="donoArtigos.php">Artigos</a>
        <a href="donoDestaque.php">Destaque</a>
        <a href="mensagens.php">Mensagens</a>
    </div>
    <div class="phppot-container">
        <div class="page-header">
            <span class="login-signup"><a href="logout.php">Logout</a></span>
        </div>
        <div class="page-content">Welcome <?php echo htmlspecialchars($username)?></div>
        <div class="page-content">Id: <?php echo htmlspecialchars($Id)?></div>
        
    </div>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <td>Nivel:</td>
                <td>
                    <input type="text" name="form_user_nivel" value="<?php
                    if (isset($UserNivel)) {
                        echo htmlspecialchars($UserNivel);
                    } ?>">
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="form_user_username" value="<?php
                    if (isset($UserUsername)) {
                        echo htmlspecialchars($UserUsername);
                    } ?>">
            </tr>

            <tr>
            <td colspan="2">
                <input type="hidden" name="save" value="<?php echo htmlspecialchars($UserID); ?>">
                <input type="submit" value="Save">
            </td>
        </tr>   
        </table>
    </form>

    <?php $user = $utilizador_list_dono ?>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nivel</th>
                <th>Username</th>
                <th>Email</th>
                <th>Criação</th>
                <th>Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($user as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']) ?></td>
                    <td><?php echo htmlspecialchars($user['Nivel']) ?></td>
                    <td><?php echo htmlspecialchars($user['username']) ?></td>
                    <td><?php echo htmlspecialchars($user['email']) ?></td>
                    <td><?php echo htmlspecialchars($user['create_at']) ?></td>
                    <td>
                        <?php
                        $url = htmlspecialchars($_SERVER['PHP_SELF']);
                        ?>
                        <form method="post" action="<?php echo $url; ?>">
                            <input type="hidden" name="edit" value="<?php echo htmlspecialchars($user['id']); ?>">
                            <input type="submit" name="submit" value="Edit">
                        </form>
                        <a href="<?php echo htmlspecialchars(HOME_URI); ?>?del=<?php echo htmlspecialchars($user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Del</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>        
    </body>
</html>