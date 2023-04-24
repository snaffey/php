<?php


class NoticiaController extends MainController{

    public function __construct(){
        parent::__construct();
        $this->stylesheet="noticia.css";
        $this->title="Noticia";
        $this->model = $this->loadModel("NoticiaModel");
        $this->permission_required = "Gerir-noticias";
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
            include_once APPLICATIONPATH.'/views/includes/header.php';
            include_once APPLICATIONPATH.'/views/includes/menu.php';
            include_once APPLICATIONPATH.'/views/includes/404.php';
            include_once APPLICATIONPATH.'/views/includes/footer.php';
            return;
        }
        $noticia = $this->model->getNoticia($parametros[0]);
        if ($noticia === false) {
            include_once APPLICATIONPATH.'/views/includes/header.php';
            include_once APPLICATIONPATH.'/views/includes/menu.php';
            include_once APPLICATIONPATH.'/views/includes/404.php';
            include_once APPLICATIONPATH.'/views/includes/footer.php';
            return;
        }
        $adm = false;
        if ($this->hasPermissions($this->permission_required, $this->userInfo->permissions)){
            if($this->userInfo->associacaoId == $noticia->associacaoId || in_array('Superadmin', $this->userInfo->permissions))
                $adm = true;
        }
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/noticia/noticia-view.php';
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
        $superAdm = $this->hasPermissions('Superadmin', $this->userInfo->permissions);
        if (!$this->hasPermissions($this->permission_required, $this->userInfo->permissions)){
            gotoPage("home/?error=af");
            return;
        }
        $assocId = $this->model->getAssociacaoId();
        $assocs = $this->model->getAll();

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
        include_once APPLICATIONPATH.'/views/noticia/criar-noticia-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function editar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!isset($parametros[0])){
            gotoPage('404/');
            return;
        }
        $noticia = $this->model->getNoticia($parametros[0]);
        if ($noticia === false) {
            gotoPage("404/");
            return;
        }
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?'?next='.$nextPage:""));
            return;
        }
        if (!$this->hasPermissions($this->permission_required, $this->userInfo->permissions)){
            gotoPage("home/?error=af");
            return;
        }
        if (!$this->model->userIsOnNoticiaAssociacao($parametros[0]) && !$this->hasPermissions('Superadmin', $this->userInfo->permissions)){
            gotoPage("home/?error=af");
            return;
        }
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/noticia/editar-noticia-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function apagar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        $id = $parametros[0];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?$nextPage:""));
            return;
        }
        if (!$this->hasPermissions($this->permission_required, $this->userInfo->permissions)){
            gotoPage("home/?error=af");
            return;
        }
        if (!$this->model->userIsOnNoticiaAssociacao($id) && !$this->hasPermissions('Superadmin', $this->userInfo->permissions)){
            gotoPage("home/?error=af");
            return;
        }
        $this->model->delete($id);
        gotoPage('?success=6');
    }

    public function all(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!isset($parametros[0])){
            gotoPage('500/');
            return;
        }
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?$nextPage:""));
            return;
        }
        if (!$this->model->userIsOnAssociacao($parametros[0]) && !$this->superAdm){
            gotoPage('?error=af');
            return;
        }
        $noticias = $this->model->getAllByAssociacao($parametros[0]);
        $noticiasHTML = "<p class='none-msg'>Esta associacao não tem nenhuma noticia!</p>";
        if (count($noticias) > 0) {
            $noticiasHTML = iterate($noticias, function ($el) {
                $titulo = $el->titulo;
                $conteudo = $el->conteudo;
                $img = $el->caminhoImg;
                $id = $el->id;
                $act = "";
                if ($this->hasPermissions('Gerir-noticias', $this->userInfo->permissions))
                    $act = "<div class='edt-cntrls'><a class='edt-btn' href=\"" . HOME_URI . "noticia/editar/" . $id . "\">Editar</a><a class='edt-btn' href=\"" . HOME_URI . "noticia/apagar/" . $id . "\">Apagar</a></div>";


                return <<<HTML
                            <div class="ntc-card">
                                <h1>$titulo</h1>
                                <p>$conteudo</p>
                                <img src="$img" alt="">
                                $act                      
                            </div>
                        HTML;
            });
            $noticiasHTML = implode(' ', $noticiasHTML);
        }

        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/noticia/noticia-all-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }
}