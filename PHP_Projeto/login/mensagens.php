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
require_once $upOne . '/lib/callsMensagem.php';

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
        <a href="dono.php">Users</a>
    </div>
    <div class="phppot-container">
        <div class="page-header">
            <span class="login-signup"><a href="logout.php">Logout</a></span>
        </div>
        <div class="page-content">Welcome <?php echo htmlspecialchars($username)?></div>
        <div class="page-content">Id: <?php echo htmlspecialchars($Id)?></div>
        
    </div>
    <?php $msg = $msg_list ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Assunto</th>
                <th>Mensagem</th>
                <th>Data</th>
                <th>Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($msg as $mensagem): ?>
                <tr>
                    <td><?php echo htmlspecialchars($mensagem['Id']) ?></td>
                    <td><?php echo htmlspecialchars($mensagem['Nome']) ?></td>
                    <td><?php echo htmlspecialchars($mensagem['Email']) ?></td>
                    <td><?php echo htmlspecialchars($mensagem['Assunto']) ?></td>
                    <td><?php echo htmlspecialchars($mensagem['Mensagem']) ?></td>
                    <td><?php echo htmlspecialchars($mensagem['Data']) ?></td>
                    <td>
                        <a href="<?php echo htmlspecialchars(HOME_URI); ?>?del=<?php echo htmlspecialchars($mensagem['Id']); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Del</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>        
    </body>
</html>