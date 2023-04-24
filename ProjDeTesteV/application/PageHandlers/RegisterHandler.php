<?php


class RegisterHandler extends PageHandler{

    public PasswordHash $passwordHasher;

    public function __construct(){
        $this->passwordHasher = new PasswordHash();
        $this->model = $this->loadModel('UserModel');
    }

    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        var_dump($parametros);
        if (LoginCore::getUserId() === false){
            gotoPage('login/?error=af&next='.gotoPage($_GET['path']));
            return;
        }
        if (!isset($parametros[0])){
            gotoPage('500/');
            return;
        }
        $assocId = $parametros[0];
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            gotoPage($parametros['get']['path'] . '?error=eu');
            return;
        }
        $username = $_POST['username'];
        if (defined(USERNAMEREGEXVALIDATOR)) {
            if (!preg_match(USERNAMEREGEXVALIDATOR, $username)) {
                gotoPage($parametros['get']['path'] . '?error=iu');
                return;
            }
        }
        if ($this->model->usernameExists($username)){
            gotoPage($parametros['get']['path'] . '?error=ue');
            return;
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            gotoPage($parametros['get']['path'] . '?error=ep');
            return;
        }
        $password = $_POST['password'];
        if (strlen($password) < PASSWORDMINSIZE || strlen($password) > PASSWORDMAXSIZE){
            gotoPage($parametros['get']['path'] . '?error=ip');
            return;
        }

        if (!isset($_POST['rPassword']) || empty($_POST['rPassword'])) {
            gotoPage($parametros['get']['path'] . '?error=erp');
            return;
        }
        $rPassword = $_POST['rPassword'];
        if ($password != $rPassword) {
            gotoPage($parametros['get']['path'] . '?error=nep');
            return;
        }
        if (!isset($_POST['nome']) || empty($_POST['nome'])){
            gotoPage($parametros['get']['path'] . '?error=enf');
            return;
        }
        $nome = $_POST['nome'];
        if (!isset($_POST['email']) || empty($_POST['email'])){
            gotoPage($parametros['get']['path'] . '?error=eef');
            return;
        }
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            gotoPage($parametros['get']['path'] . '?error=ei');
            return;
        }

        $permissions = ['Any'];
        if (isset($_POST['Admin']))
            $permissions[] = 'Admin';

        if (isset($_POST['Gerir-noticias']))
            $permissions[] = 'Gerir-noticias';

        if (isset($_POST['Gerir-eventos']))
            $permissions[] = 'Gerir-eventos';
        $permissions = serialize($permissions);
        $hashedPassword = $this->passwordHasher->encrypt($password);
        $this->model->insert($username, $hashedPassword, $email, $nome, $assocId, $permissions);
        if (isset($_POST['nextPage']) && $_POST['nextPage'] != "") {
            $prefix = (str_contains($_POST['nextPage'], '?'))?'&':'?';
            gotoPage($_POST['nextPage'].$prefix.'success=3');
            return;
        }
        gotoPage('login/?success=3');
    }
}