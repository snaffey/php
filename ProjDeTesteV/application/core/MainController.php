<?php


/**
 * Class MainController
 * @author Rafael Velosa
 */
abstract class MainController extends LoginCore implements Controller{

    /**
     * Guarda o titulo da pagina
     * @var $title
     */
    public $title;

    /**
     * Guarda o modelo para este controlador se for necessario
     * @var $model
     */
    public $model;

    /**
     * Guarda se é nessesario login por defeito não é nessesario
     * @var bool $login_required
     */
    public $login_required = false;

    /**
     * Guarda as permissoes nessesarias para entrar nesta pagina
     * @var string $permission_required
     */
    public $permission_required = 'Any';

    /**
     * Guarda o nome da folha de estilo caso tenha
     * @var $stylesheet
     */
    public $stylesheet = '';

    /**
     * Guarda o nome do ficheiro script caso tenha
     * @var $stylesheet
     */
    protected string $script = '';

    /**
     * Guarda uma msg para o user
     * @var $msg
     */
    public $msg = null;

    /**
     * MainController constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->msg = Messages::run($_GET);
        if ($this->loggedIn) {
            $this->adm = $this->hasPermissions('Admin', $this->userInfo->permissions);
        }
    }

    /**
     * Carega um modelo se este existir
     * @param $modelName
     * @return mixed
     */
    public function loadModel($modelName){
        $modelName = ucfirst($modelName);
        $path = APPLICATIONPATH."/models/$modelName.php";
        if (file_exists($path)) {
            require_once $path;
            if (class_exists($modelName))
                return new $modelName($this->userInfo);
        }
        include_once APPLICATIONPATH.'/views/includes/404.php';
        return false;
    }

    /**
     * Pagina Index
     */
    abstract public function index();
}