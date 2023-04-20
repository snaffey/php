<?
    class AssociacoesController extends MainController {
        public $login_required = false;
        public $permission_required;
        public $prev_page = false;
        public $associacoes = array();
        public function index() {
            $this->title = 'Associacoes';
            $this->load_class_assoc('associacoes/associacoes-entrar-model');
            $modelo = $this->load_model('associacoes/associacoes-entrar-model');
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/_includes/menu.php';
            require ABSPATH . '/views/associacoes/associacoes-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
        
        public function adm() {
            $this->title = 'Adm Gerenciar associacoes';
            $this->permission_required = array('adm-gerir-associacoes');
            if (!$this->logged_in) {
                $this->logout();
                $this->goto_login();
                return;
            }
            if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
                echo 'Não tem permissões para aceder essa página.';
                return;
            }
            $this->load_class_assoc('associacoes/associacoes-adm-model');
            $modelo = $this->load_model('associacoes/associacoes-adm-model');
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/_includes/menu.php';
            require ABSPATH . '/views/associacoes/associacoes-adm-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }

        public function dono() {
            $this->title = 'Gerenciar associacoes';
            $this->permission_required = array('gerir-associacoes');
            if (!$this->logged_in) {
                $this->logout();
                $this->goto_login();
                return;
            }
            if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
                echo 'Não tem permissões para aceder essa página.';
                return;
            }
            $this->load_class_assoc('associacoes/associacoes-dono-model');
            $modelo = $this->load_model('associacoes/associacoes-dono-model');
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/_includes/menu.php';
            require ABSPATH . '/views/associacoes/associacoes-dono-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }

        public function user() {
            $this->title = 'Minhas associacoes';
            $this->permission_required = array('ver-associacao');
            if (!$this->logged_in) {
                $this->logout();
                $this->goto_login();
                return;
            }
            if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
                echo 'Não tem permissões para aceder essa página.';
                return;
            }
            $this->load_class_assoc('associacoes/associacoes-user-model');
            $modelo = $this->load_model('associacoes/associacoes-user-model');
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/_includes/menu.php';
            require ABSPATH . '/views/associacoes/associacoes-user-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }

        public function criar() {
            $this->title = 'Criar associacoes';
            $this->permission_required = array('any');
            if (!$this->logged_in) {
                $this->logout();
                $this->goto_login();
                return;
            }
            $this->load_class_assoc('associacoes/associacoes-criar-model');
            $modelo = $this->load_model('associacoes/associacoes-criar-model');
            require ABSPATH . '/views/_includes/header.php';
            require ABSPATH . '/views/_includes/menu.php';
            require ABSPATH . '/views/associacoes/associacoes-criar-view.php';
            require ABSPATH . '/views/_includes/footer.php';
        }
    }
?>