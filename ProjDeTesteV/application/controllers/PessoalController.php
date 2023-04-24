<?php


class PessoalController extends MainController{

    public function __construct(){
        parent::__construct();
        $this->stylesheet="pessoal.css";
        $this->model = $this->loadModel('UserModel');
        $this->script = "pessoal.js";
    }

    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $pagina = $parametros['get']['path'];
        if (!$this->loggedIn){
            gotoPage("login/?error=af&next=$pagina");
            return;
        }
        $superAdm = $this->hasPermissions('Superadmin', $this->userInfo->permissions);
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        $pageNum = $parametros['get']['page'] ?? 1;

        $eventosPaginator = new Paginator($this->model->getTotalEventos($this->superAdm, $this->adm), 2,  $pageNum);
        $eventos = $eventosPaginator->getItens("select eventos.* from eventos inner join eventoInscricoes on eventoInscricoes.eventoId=eventos.id and eventoInscricoes.socioId=:socioId limit :offset, :limit;", [':socioId'=>$this->userInfo->id]);
        $quotasPaginator = new Paginator($this->model->getTotalQuotas($this->superAdm, $this->adm), 3, $pageNum);
        $quotas = $quotasPaginator->getItens("select quotas.* from quotas where socioId=:socioId and status='active' limit :offset, :limit;", [':socioId'=>$this->userInfo->id]);
        $noticiasPaginator = new Paginator($this->model->getTotalNoticias($this->superAdm, $this->adm), 2,  $pageNum);
        if ($this->superAdm) {
            $noticias = $noticiasPaginator->getItens("select noticias.*, associacao.nome from noticias inner join associacao on noticias.associacaoId=associacao.id limit :offset, :limit;");
            $quotas = $quotasPaginator->getItens("select quotas.*, socio.username as nome from quotas inner join socio on quotas.socioId=socio.id and status='active' limit :offset, :limit;");
        }else if ($this->adm){
            $noticias = $noticiasPaginator->getItens("select noticias.*, associacao.nome from noticias inner join associacao on noticias.associacaoId=associacao.id where associacao.id=:associacaoId  limit :offset, :limit;", [':associacaoId'=>$this->userInfo->associacaoId]);
            $quotas = $quotasPaginator->getItens("select quotas.*, socio.username as nome from quotas inner join socio on quotas.socioId=socio.id where socio.associacaoId=:associacaoId and status='active' limit :offset, :limit;", [':associacaoId'=>$this->userInfo->associacaoId]);
            $eventos = $eventosPaginator->getItens("select * from eventos where associacaoId=:associacaoId  limit :offset, :limit;", [':associacaoId'=>$this->userInfo->associacaoId]);
        }else{
            $noticias = $noticiasPaginator->getItens("select noticias.* from noticias inner join noticiasGostos on noticiasGostos.noticiaId=noticias.id and noticiasGostos.socioId=:socioId limit :offset, :limit;", [':socioId' => $this->userInfo->id]);
            $quotas = $quotasPaginator->getItens("select quotas.* from quotas where socioId=:socioId and status='active' limit :offset, :limit;", [':socioId'=>$this->userInfo->id]);
        }
        if ($this->superAdm){
            $eventos = $this->model->getAllEventosByAssoc(false);
            $socios = $this->model->getAllSociosByAssoc();
            $sociosHTML = [];
            iterate ($socios, function($el) use (&$sociosHTML){
                $sociosHTMLS = [];
                for ($i = 0; $i < count($el['socios']); $i++){
                    $socio = $el['socios'][$i];
                    $nome = $socio->nome;
                    $email = $socio->email;
                    $username = $socio->username;
                    $permissions = implode( ', ', unserialize($socio->permissions));
                    $id = $socio->id;
                    $editPerms = HOME_URI . "pessoal/perms/$id";
                    // todo $enviarEmail = HOME_URI . "pessoal/email/$id";
                    $sociosHTMLS[] = <<<HTML
                            <div class="grid quota-card">
                                <div class="info">
                                    <p>Nome: $nome</p>
                                    <p>Email: $email</p>
                                    <p>Username: $username</p>
                                    <p>Permissões: $permissions</p>                                 
                                </div>
                                <div class="action">
                                    <form action="" method="post">
                                        <input type="hidden" name="userId" value="$id">
                                        <input type="submit" value="Enviar email">
                                    </form>
                                    <form action="$editPerms">                                    
                                        <input type="submit" value="Editar Permições">
                                    </form>                               
                                </div>
                            </div>
                    HTML;
                }
                $sociosHTMLS = implode(' ', $sociosHTMLS);
                $assocNome = $el['assocNome'];
                $sociosHTML[] = <<<HTML
                                    <h3>$assocNome</h3>
                                    <div>
                                        $sociosHTMLS
                                    </div>
                                HTML;
            });
            $sociosHTML = implode(' ', $sociosHTML);
            $assocs = $this->model->getAllAssociacoes();
            $options = iterate($assocs, function ($el){
                return "<option value='$el->id'>$el->nome</option>";
            });
            $options = implode(' ', $options);
            $eventosHTML = [];
            iterate ($eventos, function($el) use (&$eventosHTML){
                $eventosHTMLS = [];
                for ($i = 0; $i < count($el['eventos']); $i++){
                    $evento = $el['eventos'][$i];
                    $id = $evento->id;
                    $titulo = $evento->titulo;
                    $conteudo = $evento->conteudo;
                    $data = $evento->data;
                    $clonarBtn = '';
                    if ($this->superAdm)
                        $clonarBtn = "<button class='clonar-btn'>Clonar</button>";
                    $eventosHTMLS[] = <<<HTML
                            <div class="evento-card">
                                <div class="grid" id="$id">
                                    <div>
                                        <p>$titulo</p>
                                        <p>$conteudo</p>
                                        <p>$data</p>
                                    </div>
                                    <div>
                                        $clonarBtn
                                    </div>
                                </div>
                            </div>
                    HTML;
                }
                $eventosHTMLS = implode(' ', $eventosHTMLS);
                $assocNome = $el['assocNome'];
                $eventosHTML[] = <<<HTML
                                    <h3>$assocNome</h3>
                                    <div>
                                        $eventosHTMLS
                                    </div>
                                HTML;
            });
        }else{
            $eventosHTML = "<p>Este user ainda não participou em nenhum evento!</p>";
            if (count($eventos)>0){
                $eventosHTML = iterate($eventos, function ($el){
                    $id = $el->id;
                    $titulo = $el->titulo;
                    $conteudo = $el->conteudo;
                    $data = $el->data;
                    $clonarBtn = '';
                    if ($this->superAdm)
                        $clonarBtn = "<button class='clonar-btn'>Clonar</button>";
                    return <<<HTML
                            <div class="evento-card">
                                <div class="grid" id="$id">
                                    <div>
                                        <p>$titulo</p>
                                        <p>$conteudo</p>
                                        <p>$data</p>
                                    </div>
                                    <div>
                                        $clonarBtn
                                    </div>
                                </div>
                            </div>
                    HTML;
                });
            }
        }
        if (count($eventos) > 0)
            $eventosHTML = implode(' ', $eventosHTML);
        $noticiasHTML = "<p>Este user ainda não gostou de nenhuma noticia!</p>";
        if (count($noticias)>0){
            $noticiasHTML = iterate($noticias, function ($el){
                $titulo = $el->titulo;
                $conteudo = $el->conteudo;
                $path = $el->caminhoImg;
                return <<<HTML
                            <div class="evento-card">
                                <div class="grid">
                                    <div>
                                        <img src="$path" alt="" style="height: 120px;width: auto;">
                                    </div>
                                    <div>
                                        <p>$titulo</p>
                                        <p>$conteudo</p>
                                    </div>
                                </div>
                            </div>
                    HTML;
            });
            $noticiasHTML = implode(' ', $noticiasHTML);
        }
        $quotasHTML = "<p>Este user não tem nenhuma quota pendente!</p>";
        if (count($quotas)>0) {
            $quotasHTML = iterate($quotas, function ($el) {
                $dComeco = $el->dataComeco;
                $dFim = $el->dataTermino;
                $preco = $el->preco;
                $id = $el->id;
                $nome = $el->nome;
                $path = HOME_URI . 'quota/pagar/';
                $dono = "";
                if($this->adm){
                    $dono = "<p>Username: $nome</p>";
                }
                return <<<HTML
                            <div class="grid quota-card">
                                <div class="info">
                                    <p>Data de começo: $dComeco</p>
                                    <p>Data de termino: $dFim</p>
                                    <p>Preço: $preco</p>
                                    $dono
                                </div>
                                <div class="action">
                                    <form action="$path" method="post">
                                        <input type="hidden" name="quotaId" value="$id">
                                        <input type="submit" value="Pagar">
                                    </form>
                                </div>
                            </div>
                    HTML;
            });
            $quotasHTML = implode(' ', $quotasHTML);
        }
        $eventosPaginator = $eventosPaginator->getPageInfo();
        $quotasPaginator = $quotasPaginator->getPageInfo();
        $noticiasPaginator = $noticiasPaginator->getPageInfo();
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/pessoal/pessoal-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function perms(){
        if (!$this->loggedIn){
            gotoPage('home/?error=af');
            return;
        }
        $superAdm = $this->hasPermissions('Superadmin', $this->userInfo->permissions);
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        if (!$superAdm){
            gotoPage('home/?error=af');
            return;
        }
        if (!isset($parametros[0])) {
            gotoPage('500/');
            return;
        }
        $id = $parametros[0];
        $userInfo = $this->model->getUserInfo($id);
        $permissions = $userInfo->permissions;
        $username = $userInfo->username;
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/pessoal/pessoal-perms-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }

    public function adicionarquotas(){
        $dia = date('d');
        if($dia == 1)
            if($this->model->addQuotasAll()) {
                echo '{"sending":true}';
                return;
            }
        echo '{"sending":false}';
    }
}