<?php

/**
 * Configuração geral
 */
// Caminho para a raiz
define('ABSPATH', dirname(__FILE__));

// Caminho para a pasta de uploads
define('UP_ABSPATH', ABSPATH . '/views/_uploads');

// URL da home
define('HOME_URI', 'http://localhost:41062/www/projmvc');

// Nome do host da base de dados
define('HOSTNAME', '127.0.0.1');

// Nome do DB
define('DB_NAME', 'projeto_mvc');

// User do DB
define('DB_USER', 'Tiago');

// Pass do DB
define('DB_PASSWORD', '123');

// Charset da conexão PDO
define('DB_CHARSET', 'utf8');

// Programador, modifique o valor para true
define('DEBUG', true);

// Carrega o loader, que vai carregar a aplicação inteira
require_once ABSPATH . '/loader.php';
?>