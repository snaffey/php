<?php

/**
 * Configuração geral
 */

/**Nome da pasta root do projeto
 *Em caso que o projeto esteja na root do servidor deixe esta variavel vazia
 */
define("ROOTFOLDERNAME", "testeProjV/");

// Caminho para a pasta application
define('APPLICATIONPATH',dirname(__FILE__));

// Caminho absoluto da pasta root do projeto
define('ABSPATH', dirname(APPLICATIONPATH));

// Caminho para a pasta public
define('PUBLICPATH', ABSPATH . '/public');

// Caminho para a pasta de uploads
define('UP_ABSPATH', ABSPATH . '/public/uploads');

// URL da home
define('HOME_URI', "http://".$_SERVER['HTTP_HOST']."/www/".ROOTFOLDERNAME);

// Caminho para a pasta de uploads
define('UP_URI', HOME_URI . 'public/uploads');

// Nome do host do servidor MYSQL
define('DB_HOSTNAME', '127.0.0.1');

// Nome da Base de dados
define('DB_NAME', 'bleet');

// Username para aceder ao servidor MYSQL
define('DB_USERNAME', 'Tiago');

// Password para aceder ao servidor MYSQL
define('DB_PASSWORD', '123');

// Charset da conexão PDO
define('DB_CHARSET', 'utf8');

// ----------- Configurações de aplicação -------------------------------------------------------------

// define o tamanho maximo que a password deve ter
define('PASSWORDMAXSIZE', 30);

// define o tamanho minimo que a password deve ter
define('PASSWORDMINSIZE', 3);

// define o regex que valida o username
/*
 * O username:
 * tem de consistir de caracteres aplhanumericos maisculos ou minusculos
 * pode ter ( _ ou - ) mas não pode telos de seguida
 * e tem de estar entre 3 e 30 caracteres
 */
define('USERNAMEREGEXVALIDATOR', '/^[a-zA-Z0-9]([_-](?![_-])|[a-zA-Z0-9]){1,28}[a-zA-Z0-9]$/');

// define o tamanho maxximo dos ficheiros para upload
define("MAXFILESIZE", 5000000);

// ----------- Fim de configurações de aplicação ------------------------------------------------------

/*
 * Modo desenvolvimento
 * true -> caso esteja a programar e deseja que o php reporte os erros
 * false -> caso o projeto esteja concluido e não deseje que o php reporte os erros
 */
define('DEBUG', true);

// Carrega o loader, que vai carregar a aplicação inteira
require APPLICATIONPATH . "/loader.php"
?>