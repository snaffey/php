<?php
    // inicia a sessão caso seja nessesario
    session_start();

if ( !defined('DEBUG') || DEBUG === false ) {
    // Php para de reportar erros
    error_reporting(0);
} else {
    // php reporta todos os erros
    error_reporting(E_ALL);
}

/*Zona de requires*/
require APPLICATIONPATH . '/libraries/autoloader.php';
require APPLICATIONPATH . '/libraries/util.php';

require_once APPLICATIONPATH . '/controllers/HomeController.php';
require_once APPLICATIONPATH . '/controllers/ErrorController.php';
require_once APPLICATIONPATH . '/controllers/LoginController.php';
require_once APPLICATIONPATH . '/controllers/RegisterController.php';
require_once APPLICATIONPATH . '/controllers/AssociacaoController.php';
require_once APPLICATIONPATH . '/controllers/EventoController.php';
require_once APPLICATIONPATH . '/controllers/NoticiaController.php';
require_once APPLICATIONPATH . '/controllers/PessoalController.php';
require_once APPLICATIONPATH . '/PageHandlers/LoginHandler.php';
require_once APPLICATIONPATH . '/PageHandlers/RegisterHandler.php';
require_once APPLICATIONPATH . '/PageHandlers/NoticiaHandler.php';
require_once APPLICATIONPATH . '/PageHandlers/PessoalHandler.php';
require_once APPLICATIONPATH . '/PageHandlers/QuotaHandler.php';
require_once APPLICATIONPATH . '/PageHandlers/EventoHandler.php';
require_once APPLICATIONPATH . '/PageHandlers/AssociacaoHandler.php';
/*end*/

$app = new Application();
$app->router->get('404/', new ErrorController);
$app->router->get('500/', new ErrorController);
$app->router->get('/', new HomeController);
$app->router->get('home/', new HomeController);
$app->router->get('login/', new LoginController);
$app->router->post('login/', new LoginHandler);
$app->router->get('register/', new RegisterController);
$app->router->post('register/', new RegisterHandler);
$app->router->get('associacao/', new AssociacaoController);
$app->router->post('associacao/', new AssociacaoHandler);
$app->router->get('evento/', new EventoController);
$app->router->post('evento/', new EventoHandler);
$app->router->get('noticia/', new NoticiaController);
$app->router->post('noticia/', new NoticiaHandler);
$app->router->get('pessoal/', new PessoalController);
$app->router->post('pessoal/', new PessoalHandler);
$app->router->post('quota/', new QuotaHandler);
$app->run();
