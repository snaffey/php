<?php


/**
 * Class RegisterController
 * @author Rafael Velosa
 */
class RegisterController extends MainController{

    /**
     * Guarda o titulo da pagina
     * @var string $title
     */
    public $title = "Register";

    /**
     * RegisterController constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->stylesheet = "auth.css";
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
        $superAdm = $this->hasPermissions('Superadmin', $this->userInfo->permissions);
        $nextPage = null;
        if (isset($parametros['get']['next']))
        $nextPage = $parametros['get']['next'];
        if (!isset($parametros[0])){
            gotoPage('500/');
            return;
        }
        $assocId = $parametros[0];
        if (!$this->hasPermissions('Admin', $this->userInfo->permissions)){
            gotoPage('?error=af');
            return;
        }
        $assocModel = $this->loadModel('AssociacaoModel');
        if (!$assocModel->userIsOnAssociacao($assocId) && !$superAdm){
            gotoPage('?error=af');
            return;
        }
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/register/register-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }
}