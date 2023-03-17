<?php
//caminho raiz
define('ABSPATH', dirname(__FILE__));

//caminho para uploads
define('UP_ABSPATH', ABSPATH . '/views/_uploads');

//URL da home
define('HOME_URI', 'http://localhost:41062/www/projectOOP/');

//Nome do host do BD
define('DB_HOST', 'epcc_prog21');

//user do bd
define('DB_USER', 'Tiago');

//senha do bd
define('DB_PASSWORD', '123');

//charset
define('DB_CHARSET', 'utf8');

//modo de debug
define('DEBUG', true);

//caminho raiz e chamar o loader
require_once ABSPATH . '/loader.php';

?>