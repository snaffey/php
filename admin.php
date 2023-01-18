<?php
session_start();
print_r($_SESSION);
if (isset($_SESSION['nome'], $_SESSION['permite'])) {
    echo 'Session ID: '.session_id().'<br>';
    echo 'Tem permissao'.$_SESSION['nome'];
}
if (session_destroy()) {
    echo 'Sessão destruida';
    session_write_close();
    unset($_SESSION['nome']);
}
?>

<html>
    <head>
        <title>Admin</title>
    </head>
    <body>

    </body>
</html>