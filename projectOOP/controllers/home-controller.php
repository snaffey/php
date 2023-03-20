<?php

class HomeController extends MainController
{
    public function index()
    {
        $this->title = 'Home';
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        require_once ABSPATH . '/views/includes/header.php';
        require_once ABSPATH . '/views/includes/menu.php';
        require_once ABSPATH . '/views/home/home-view.php';
        require_once ABSPATH . '/views/_includes/footer.php';
    }
}
