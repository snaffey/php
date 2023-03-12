<?php
class Conexao
{
    private static $instance;
    private function __construct() {}
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Conexao();
            //new PDO('mysql:host=localhost;dbname=epcc', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
        echo "Conexão realizada com sucesso!";
        return self::$instance;
    }
}

$f = Conexao::getInstance();
$f1 = Conexao::getInstance();
for ($i = 0; $i < 1000; $i++) {
    $f = Conexao::getInstance();
}

?>