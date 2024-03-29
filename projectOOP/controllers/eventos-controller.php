<<<<<<< HEAD:projectOOP/controllers/eventos-controller.php
<?php

class eventosController extends MainController {

    public $login_required = false;
    public $permission_required;
    public $prev_page = false;
    /**
     * Carrega a página "/views/eventos/index.php"
     */
    public function index() {
        // Título da página
        $this->title = 'eventos';
        // Carrega o modelo para este view
        $modelo = $this->load_model('eventos/eventos-adm-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/eventos/index.php
        require ABSPATH . '/views/eventos/eventos-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index

    /**
     * Carrega a página "/views/eventos/eventos-adm-view.php"
     */
    public function adm() {
        // Page title
        $this->title = 'Gerenciar eventos';
        $this->permission_required = 'gerir-eventos';
        // Verifica se o user está logado
        if (!$this->logged_in) {
            // Se não; garante o logout
            $this->logout();
            // Redireciona para a página de login
            $this->goto_login();
            // Garante que o script não vai passar daqui
            return;
        }
        // Verifica se o user tem a permissão para aceder essa página
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
            // Exibe uma mensagem
            echo 'Não tem permissões para aceder essa página.';

            // Finaliza aqui
            return;
        }

        // Carrega o modelo para este view
        $modelo = $this->load_model('eventos/eventos-adm-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/eventos/index.php
        require ABSPATH . '/views/eventos/eventos-adm-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// adm
}

// class NoticiasController
=======
<?php

class ProjetosController extends MainController
{
    public $login_required = false;
    public $permission_required;
    public $prev_page = false;
    /**
     * Carrega a página "/views/projetos/index.php"
     */
    public function index()
    {
        // Título da página
        $this->title = 'Projetos';
        // Carrega o modelo para este view
        $modelo = $this->load_model('projetos/projetos-adm-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/projetos/index.php
        require ABSPATH . '/views/projetos/projetos-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// index

    /**
     * Carrega a página "/views/projetos/projetos-adm-view.php"
     */
    public function adm()
    {
        // Page title
        $this->title = 'Gerenciar projetos';
        $this->permission_required = 'gerir-projetos';
        // Verifica se o user está logado
        if (!$this->logged_in) {
            // Se não; garante o logout
            $this->logout();
            // Redireciona para a página de login
            $this->goto_login();
            // Garante que o script não vai passar daqui
            return;
        }
        // Verifica se o user tem a permissão para aceder essa página
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
            // Exibe uma mensagem
            echo 'Não tem permissões para aceder essa página.';

            // Finaliza aqui
            return;
        }

        // Carrega o modelo para este view
        $modelo = $this->load_model('projetos/projetos-adm-model');

        /** Carrega os arquivos do view * */
        // /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

        // /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

        // /views/projetos/index.php
        require ABSPATH . '/views/projetos/projetos-adm-view.php';

        // /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';
    }

// adm
}

// class NoticiasController
>>>>>>> 0b8ee74e0988d774852e8612b0a76bfb016f58b4:projectOOP/controllers/projetos-controller.php
