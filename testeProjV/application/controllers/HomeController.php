<?php


class HomeController extends MainController{
    public function __construct(){
        parent::__construct();
        $this->stylesheet = "home.css";
        $this->model = $this->loadModel('EventoModel');
        $this->script = "home.js";
    }
    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        if (!$this->loggedIn){
            gotoPage('login/?error=af&next=home/');
            return;
        }
        $eventos = $this->model->getAllAssociacao($this->userInfo->associacaoId);
        if ($this->superAdm){
            $eventos = $this->model->getAll();
            $assocs = $this->model->getAllAssocs();
            $options = iterate($assocs, function ($el) use ($parametros){
                $selected = (isset($parametros['get']['assocId'])
                    && $parametros['get']['assocId'] == $el->id)?'selected="selected"':'';
                return <<<HTML
                        <option value="$el->id" $selected>$el->nome</option>
                    HTML;
            });
            $assocOptions = implode(' ', $options);
            if (isset($parametros['get']['assocId']) && !empty($parametros['get']['assocId']))
                $eventos = $this->model->getAllAssociacao($parametros['get']['assocId']);
        }

        if (isset($parametros['get']['dateS'])
            && !empty($parametros['get']['dateS'])){
            $dataStart = $parametros['get']['dateS'];
            $dataStartTime = strtotime($dataStart);
            $eventos = filter($eventos, function ($el) use ($parametros, $dataStartTime){
                $dataEvento = strtotime(explode(' ', $el->data)[0]);
                return $dataEvento >= $dataStartTime;
            });
        }

        if (isset($parametros['get']['dateF'])
            && !empty($parametros['get']['dateF'])){
            $dataEnd = $parametros['get']['dateF'];
            $dataEndTime = strtotime($dataEnd);
            $eventos = filter($eventos, function ($el) use ($parametros, $dataEndTime){
                $dataEvento = strtotime(explode(' ', $el->data)[0]);
                return $dataEvento <= $dataEndTime;
            });
        }

        $eventosHTML = "<p>Não tem eventos para ver</p>";
        if (count($eventos) > 0) {
            $eventosHTML = iterate($eventos, function ($el) {
                $titulo = $el->titulo;
                $conteudo = $el->conteudo;
                $data = explode(' ', $el->data)[0];
                $associacao = (isset($el->associacaoNome)) ? "<p>Associação: $el->associacaoNome</p>" : '';
                $id = $el->id;
                $vermais = HOME_URI . 'evento/' . $id;
                $participar = HOME_URI . 'evento/participar';
                return <<<HTML
                        <article>
                            <div class="body">                      
                                <div class="col">
                                    <h1>$titulo</h1>
                                    <p>$conteudo</p>
                                    <p>Data: $data</p>
                                    $associacao
                                    <div>
                                        <a href="$vermais">Ver mais</a>
                                        <a href="#" onclick="submit('#participar$id')">Participar</a>
                                        <form id="participar$id" action="$participar" method="post">  
                                            <input type="hidden" name="eventoId" value="$id">                                                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    HTML;
            });
            $eventosHTML = implode(' ', $eventosHTML);
        }
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/home/home-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }
}