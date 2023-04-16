<?php


class EventoController extends MainController{

    public function __construct(){
        parent::__construct();
        $this->stylesheet="evento.css";
        $this->model = $this->loadModel('EventoModel');
        $this->title="associacao";
        $this->script = "home.js";
    }

    /**
     * Pagina index
     */
    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina");
            return;
        }
        if (!isset($parametros[0])){
            gotoPage('500/');
            return;
        }
        $id = $parametros[0];
        if (!$this->model->exists($id)){
            gotoPage('404/');
            return;
        }
        if (!$this->model->eventoIsOnAssociacao($id, $this->userInfo->associacaoId) && !LoginCore::isSuperAdmin($this->userInfo->id)){
            gotoPage('?error=af');
            return;
        }
        $evento = $this->model->getEvento($id);
        $titulo = $evento->titulo;
        $conteudo = $evento->conteudo;
        $data = explode(' ', $evento->data)[0];
        $assocId = $evento->associacaoId;
        $assocNome = $evento->associacaoNome;
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/evento/evento-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function criar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?"?next=".$nextPage:""));
            return;
        }

        $assocId = $this->userInfo->associacaoId;
        $assocs = $this->model->getAllAssocs();

        $options = iterate($assocs, function ($el){
            return <<<HTML
                        <option value="$el->id">$el->nome</option>
                    HTML;
        });
        $default = <<<HTML
                        <option value="None">Selecione uma associação</option>
                    HTML;

        array_unshift($options, $default);
        $options = implode("", $options);

        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/evento/criar-evento-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function editar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?$nextPage:""));
            return;
        }
        if (!isset($parametros[0])){
            gotoPage('500/');
            return;
        }
        $id = $parametros[0];
        if (!$this->model->exists($id)){
            gotoPage('404/');
            return;
        }
        if (!$this->model->eventoIsOnAssociacao($id, $this->userInfo->associacaoId) && !LoginCore::isSuperAdmin($this->userInfo->id)){
            gotoPage('?error=af');
            return;
        }
        $evento = $this->model->getEvento($id);
        $titulo = $evento->titulo;
        $conteudo = $evento->conteudo;
        $data = explode(' ', $evento->data)[0];
        $assocId = $evento->associacaoId;

        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/evento/editar-evento-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function apagar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?$nextPage:""));
            return;
        }
        if (!isset($parametros[0])){
            gotoPage('500/');
            return;
        }
        $id = $parametros[0];
        if (!$this->model->exists($id)){
            gotoPage();
            return;
        }
        if (!$this->model->eventoIsOnAssociacao($id, $this->userInfo->associacaoId) && !LoginCore::isSuperAdmin($this->userInfo->id)){
            gotoPage('?error=af');
            return;
        }
        $this->model->delete($id);
        gotoPage('?success=6');
    }
}