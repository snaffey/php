<?php


/**
 * Class AssociacaoController
 * @author Rafael Velosa
 */
class AssociacaoController extends MainController{

    public function __construct(){
        parent::__construct();
        $this->stylesheet="associacao.css";
        $this->script="associacao.js";
        $this->model = $this->loadModel('AssociacaoModel');
        $this->title="associacao";
        $this->permission_required = 'Gerir-associcao';
    }

    /**
     * Pagina index
     */
    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?'?next='.$nextPage:""));
            return;
        }
        if (!isset($parametros[0])){
            include_once APPLICATIONPATH.'/views/includes/header.php';
            include_once APPLICATIONPATH.'/views/includes/menu.php';
            include_once APPLICATIONPATH.'/views/includes/404.php';
            include_once APPLICATIONPATH.'/views/includes/footer.php';
            return;
        }
        $assocId = $parametros[0];
        $assoc = $this->model->getAssociacaoInfo($assocId);
        if ($assoc === false){
            include_once APPLICATIONPATH.'/views/includes/header.php';
            include_once APPLICATIONPATH.'/views/includes/menu.php';
            include_once APPLICATIONPATH.'/views/includes/404.php';
            include_once APPLICATIONPATH.'/views/includes/footer.php';
            return;
        }
        if (!$this->model->userIsOnAssociacao($assocId) && !$this->superAdm){
            gotoPage("?error=af");
            return;
        }
        $socios = "<p>Esta Associação ainda não tem membros!</p>";
        if (count($assoc->socios)>0) {
            $socios = iterate($assoc->socios, function ($el) {
                $nome = $el->nome;
                $email = $el->email;
                $username = $el->username;
                $delBtn = '';
                $editBtn = '';
                $delPath = HOME_URI."associacao/apagarsocio/$el->id";
                $editPath = HOME_URI . "pessoal/perms/$el->id";
                if ($this->adm) {
                    $delBtn = "<div><a class='btn' href='#' onclick=\"confirma('$delPath')\">Remover</a></div>";
                    $editBtn = "<div><a class='btn' href='$editPath'>Editar</a></div>";
                }

                return <<<HTML
                            <article>
                                <div class="body">
                                    <div>
                                        <img src="https://picsum.photos/100/100" alt="">
                                    </div>
                                    <div>
                                        <h2>$nome</h2>
                                        <p>Email: <strong>$email</strong></p>
                                        <p>Username: <strong>$username</strong></p>
                                    </div>
                                    $delBtn
                                    $editBtn
                                </div>
                            </article>
                        HTML;
            });
            $socios = implode(" ", $socios);
        }
        $adm = $this->hasPermissions($this->permission_required, $this->userInfo->permissions);
        $gerirNoticias = $this->hasPermissions('Gerir-noticias', $this->userInfo->permissions);
        $gerirEventos = $this->hasPermissions('Gerir-eventos', $this->userInfo->permissions);
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/associacao/associacao-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function all(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?'?next='.$nextPage:""));
            return;
        }
        $assocsArr = $this->model->getAll();
        if (!$this->hasPermissions('Superadmin', $this->userInfo->permissions)){
            gotoPage("?error=af");
            return;
        }
        if (isset($parametros['get']['q']) && !empty($parametros['get']['q'])){
            $q = $parametros['get']['q'];
            $assocsArr = filter($assocsArr, function ($el) use ($q){
                return str_contains(strtoupper($el->nome), strtoupper($q));
            });
        }
        $assocs = "<p>Ainda não existem associações!</p>";
        if (count($assocsArr)>0) {
            $assocs = iterate($assocsArr, function ($el) {
                $nome = $el->nome;
                $morada = $el->morada;
                $telefone = $el->telefone;
                $nContribuinte = $el->nContribuinte;
                $editar = HOME_URI . 'associacao/editar/'.$el->id;
                $del = HOME_URI . 'associacao/apagar/'.$el->id;
                $home = HOME_URI . 'associacao/'.$el->id;
                $caminhos = $this->model->getCaminhoFotos($el->id);
                if (count($caminhos) > 1)
                    $i = rand(0,count($caminhos)-1);
                else if (count($caminhos) === 0)
                    $i = false;
                else
                    $i = 0;
                $imgPath = 'https://picsum.photos/100/100';
                if ($i !== false)
                    $imgPath = $caminhos[$i]->caminho;
                return <<<HTML
                            <article>
                                <div class="body">
                                    <div class="simg">
                                        <img src="$imgPath" alt="Img associacao">
                                    </div>
                                    <div>
                                        <h2>$nome</h2>
                                        <p>Morada: <strong>$morada</strong></p>
                                        <p>Telefone: <strong>$telefone</strong></p>
                                        <p>Nº contribuinte: <strong>$nContribuinte</strong></p>
                                        <p><a href="$home">Ver Mais</a> | <a href="$editar">Editar</a> | <a href="#" onclick="confirma('$del')">Apagar</a></p>
                                    </div>                            
                                </div>
                            </article>
                        HTML;
            });
            $assocs = implode(" ", $assocs);

        }
        $adm = $this->hasPermissions($this->permission_required, $this->userInfo->permissions);
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/associacao/associacao-all-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function criar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?'?next='.$nextPage:""));
            return;
        }
        if (!$this->hasPermissions('Superadmin', $this->userInfo->permissions)){
            gotoPage('?error=af');
            return;
        }
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/associacao/create-associacao-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function editar(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pagina = $parametros['get']['path'];
        if (!isset($parametros[0])){
            gotoPage('404');
            return;
        }
        $id = $parametros[0];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina".(($nextPage != null)?'?next='.$nextPage:""));
            return;
        }
        if (!$this->hasPermissions('Superadmin', $this->userInfo->permissions)){
            gotoPage('associacao/'.$id.'?error=af');
            return;
        }
        $assoc = $this->model->getAssociacaoInfo($id);
        if ($assoc === false){
            gotoPage('404/');
            return;
        }
        $nome = $assoc->nome;
        $morada = $assoc->morada;
        $telefone = $assoc->telefone;
        $nContribuinte = $assoc->nContribuinte;

        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/associacao/edit-associacao-view.php';
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
        if (!$this->hasPermissions('Superadmin', $this->userInfo->permissions)){
            gotoPage("home/?error=af");
            return;
        }
        $this->model->delete($id);
        gotoPage('?success=6');
    }

    public function fotos(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $assocId = $parametros[0];
        if (!$this->loggedIn)
            $res = ['error'=>'af'];
        else if (!$this->model->userIsOnAssociacao($assocId) && !$this->superAdm)
            $res = ['error'=>'af'];
        else if ($this->model->getAssociacaoInfo($assocId) === false)
            $res = ['error'=>'404'];
        else{
            $caminhos = $this->model->getCaminhoFotos($assocId);
            $res = [
                'success'=>true,
                'caminhos'=>iterate($caminhos, function ($el){
                    return $el->caminho;
                })
            ];
        }
        echo json_encode($res);
    }

    public function apagarsocio(){
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
        if (!$this->model->socioExists($id)){
            gotoPage('404/');
            return;
        }
        if ($this->userInfo->id == $id){
            gotoPage("associacao/".$this->userInfo->associacaoId."?error=nru");
            return;
        }
        if (!$this->model->userIsOnSameAssociacao($id) && !$this->superAdm){
            gotoPage("?error=af");
            return;
        }
        if (!$this->adm){
            gotoPage("home/?error=af");
            return;
        }
        $assocId = $this->model->deleteSocio($id);
        gotoPage("associacao/".$assocId."?success=6");
    }
}