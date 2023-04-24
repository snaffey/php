<?php


/**
 * Class PageHandler
 * @author Rafael Velosa
 * Serve Para responder a pedidos POST feitos aos seus respetivos controladores
 */
abstract class PageHandler{
    /**
     * Guarda uma instancia do model
     * @var MainModel
     */
    public MainModel $model;

    /**
     * Responde ao pedido Post feito ao index do respetivo controlador
     * @return mixed
     */
    abstract public function index();

    /**
     * Carega um modelo se este existir
     * @param $modelName
     * @return mixed
     */
    public function loadModel($modelName){
        $db = new Db;
        $id = LoginCore::getUserId();
        $info = [];
        if ($id !== false)
            $info = $db->getUserInfo($id);
        $modelName = ucfirst($modelName);
        $path = APPLICATIONPATH."/models/$modelName.php";
        if (file_exists($path)) {
            require_once $path;
            if (class_exists($modelName))
                return new $modelName($info);
        }
        include_once APPLICATIONPATH.'/views/includes/404.php';
        return false;
    }
}