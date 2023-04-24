<?php


/**
 * Class Application
 * @author Rafael Velosa
 */
class Application{

    /**
     * Guarda o router
     * @var Router
     */
    public Router $router;

    /**
     * Guarda a instancia da base de dados
     * @var Db
     */
    private Db $db;

    /**
     * Guarda a instancia do pedido
     * @var Request
     */
    private Request $request;

    /**
     * Application constructor.
     */
    public function __construct(){
        $this->router = new Router();
        $this->db = new Db();
        $this->getUrlInfo();
    }

    /**
     * Pega o controlador e executa
     */
    public function run(){
        $this->router->use($this->request);
    }

    /**
     * Pega informação do url e guarda numa instancia do request
     */
    private function getUrlInfo(){
        $request = strtolower($_SERVER['REQUEST_METHOD']);
        if (isset($_GET['path']))
            $this->request = new Request($_GET['path'], $request);
        else
            $this->request = new Request('/', $request);
    }
}
