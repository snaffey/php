<<<<<<< HEAD
<?php
//user-register-controller.php
class UserRegisterController extends MainController {

    public $login_required = true;
    public $permission_required='user-register';
    public function index() {
        // Título da página
        $this->title = 'User register';
        if (!$this->logged_in) {
			$this->logout();
			$this->goto_login();
			return;
		}
		if (!$this->check_permissions($this->permission_required,$this->userdata['user_permissions'])){
			 echo 'Não tem permissões para aceder esta página.';
            return;
		}
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
		
        $modelo = $this->load_model('user-register/user-register-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/eventos/index.php
        require ABSPATH . '/views/user-register/user-register-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }
}
=======
<?php

//user-register-controller.php
class UserRegisterController extends MainController
{
    public $login_required = true;
    public $permission_required='user-register';
    public function index()
    {
        // Título da página
        $this->title = 'User register';
        if (!$this->logged_in) {
            $this->logout();
            $this->goto_login();
            return;
        }
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
            echo 'Não tem permissões para aceder esta página.';
            return;
        }
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

        $modelo = $this->load_model('user-register/user-register-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/projetos/index.php
        require ABSPATH . '/views/user-register/user-register-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }
}
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4
