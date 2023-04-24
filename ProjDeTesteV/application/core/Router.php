<?php


/**
 * Class Router
 * @author Rafael Velosa
 */
class Router{

    /**
     * Guarda as rotas
     * @var array
     */
    private array $routes = [];

    /**
     * Define o controlador para quando essa pagina for requesitada
     * @param string $url
     * @param MainController $controller
     * @return null
     */
    public function get(string $url, MainController $controller){
        $this->routes[$url]['get'] = $controller;
    }

    /**
     * Define o manipulador para quando houver um pedido post para essa pagina
     * @param $url string
     * @param PageHandler $handler
     * @return null
     */
    public function post(string $url, PageHandler $handler){
        $this->routes[$url]['post'] = $handler;
    }

    /**
     * Retorna o respetivo controlador pa pagina
     * @param Request $request
     * @return null
     */
    public function use(Request $request){
        if(isset($this->routes[$request->page][$request->method])) {
            if (method_exists($this->routes[$request->page][$request->method], $request->action)) {
                $this->routes[$request->page][$request->method]->{$request->action}($request->parameters);
                return;
            }
            if (is_numeric($request->action)){
                array_unshift($request->parameters, $request->action);
                $this->routes[$request->page][$request->method]->index($request->parameters);
                return;
            }
        }
        if(isset($this->routes['404']['get'])){
            $this->routes['404']['get']->index(['errorCode' => '404']);
            return;
        }
        include_once APPLICATIONPATH."/views/includes/404.php";
        return;
    }
}