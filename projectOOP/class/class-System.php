<?php

class System
{
    private $controlador;
    private $acab;
    private $parametros;
    private $not_found = '/includes/404.php';
    public function __construct()
    {
        $this->get_url_data();
        if (!$this->controlador) {
            require_once ABSPATH . '/controllers/home-controller.php';
            $this->controlador = new HomeController();
            $this->controlador->index();
            return;
        }
    }
}
