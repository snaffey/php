<?php

// Evita que user aceda este ficheiro diretamente
if (! defined('ABSPATH')) {
    exit;
}
/*
echo 'ABSPATH->'.ABSPATH;
echo '->'.defined('ABSPATH');*/

// Inicia a sessão
session_start();
// Verifica o modo para debug
if (! defined('DEBUG') || DEBUG === false) {
    // Esconde todos os erros
    error_reporting(0);
    ini_set("display_errors", 0);
} else {
    // Mostra todos os erros
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// Funções globais
require_once ABSPATH . '/functions/global-functions.php';

// Carrega a aplicação
$system = new System();
