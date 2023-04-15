<?php

// Caminho raiz
define('ABSPATH', dirname(__FILE__));

// Caminho para uploads
define('UP_ABSPATH', ABSPATH . '/views/_uploads');

//URL home
define('HOME_URI', 'http://localhost:41062/www/projectOOP');

// Nome do host da base de dados
define('HOSTNAME', '127.0.0.1');

// Nome do DB
define('DB_NAME', 'proj_21');

// User do DB
define('DB_USER', 'Tiago');

// Palavra-passe do DB
define('DB_PASSWORD', '123');

// Charset da conexão PDO
define('DB_CHARSET', 'utf8');

// Modo programador(false- sem erros, true com erros)
define('DEBUG', true);

require_once ABSPATH . '/loader.php';
