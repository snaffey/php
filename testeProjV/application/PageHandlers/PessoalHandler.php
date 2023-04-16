<?php


class PessoalHandler extends PageHandler{

    public PasswordHash $passwordHasher;

    public function __construct(){
        $this->model = $this->loadModel('UserModel');
        $this->passwordHasher = new PasswordHash();
    }
    public function index(){
        gotoPage($_GET['path']);
    }
    public function edit(){
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : [];
        if (!isset($parametros[0])){
            gotoPage('404/');
            return;
        }
        if (LoginCore::getUserId() === false){
            gotoPage('login/?error=af&next='.gotoPage($_GET['path']));
            return;
        }
        $options = [
            'username' => function ($params){
                if (!isset($_POST['username']) || empty($_POST['username'])) {
                    gotoPage('pessoal/?error=eu');
                    return;
                }
                $username = $_POST['username'];
                if (defined(USERNAMEREGEXVALIDATOR)) {
                    if (!preg_match(USERNAMEREGEXVALIDATOR, $username)) {
                        gotoPage('pessoal/?error=iu');
                        return;
                    }
                }
                if ($this->model->usernameExists($username)){
                    gotoPage('pessoal/?error=ue');
                    return;
                }
                if($this->model->updateUsername($username)) {
                    gotoPage('pessoal/?success=5');
                    return;
                }
                gotoPage('500/');
            },
            'password' => function ($params){
                if (!isset($_POST['password']) || empty($_POST['password'])) {
                    gotoPage('pessoal/?error=ep');
                    return;
                }
                $password = $_POST['password'];
                if (strlen($password) < PASSWORDMINSIZE || strlen($password) > PASSWORDMAXSIZE){
                    gotoPage('pessoal/?error=ip');
                    return;
                }

                if (!isset($_POST['oldPassword']) || empty($_POST['oldPassword'])) {
                    gotoPage('pessoal/?error=erp');
                    return;
                }
                $oldPassword = $_POST['oldPassword'];
                $oldPasswordHash = ($this->model->getUserInfo())->password;
                if (!$this->passwordHasher->validPassword($oldPassword, $oldPasswordHash)) {
                    gotoPage('pessoal/?error=pdm');
                    return;
                }
                $newPasswordHash = $this->passwordHasher->encrypt($password);
                if($this->model->updatePassword($newPasswordHash)) {
                    gotoPage('pessoal/?success=5');
                    return;
                }
                gotoPage('500/');
            },
            'nome' => function ($params){
                if (!isset($_POST['nome']) || empty($_POST['nome'])){
                    gotoPage('pessoal/?error=enf');
                    return;
                }
                $nome = $_POST['nome'];
                if($this->model->updateNome($nome)){
                    gotoPage('pessoal/?success=5');
                    return;
                }
                gotoPage('500/');
            },
            'email' => function ($params){
                if (!isset($_POST['email']) || empty($_POST['email'])){
                    gotoPage('pessoal/?error=eef');
                    return;
                }
                $email = $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    gotoPage('pessoal/?error=ei');
                    return;
                }
                if($this->model->updateEmail($email)) {
                    gotoPage('pessoal/?success=5');
                    return;
                }
                gotoPage('500/');
            },
            'perms' => function ($params){
                $permissions = ['Any'];
                if (isset($_POST['Admin']))
                    $permissions[] = 'Admin';

                if (isset($_POST['Gerir-noticias']))
                    $permissions[] = 'Gerir-noticias';

                if (isset($_POST['Gerir-eventos']))
                    $permissions[] = 'Gerir-eventos';

                $permissions = serialize($permissions);
                $id = $params[1];
                if($this->model->updatePerms($permissions, $id)){
                    gotoPage('pessoal/?success=5');
                    return;
                }
            }
        ];
        if (isset($options[$parametros[0]])) {
            $options[$parametros[0]]($parametros);
            return;
        }
        gotoPage('404/');
    }
}