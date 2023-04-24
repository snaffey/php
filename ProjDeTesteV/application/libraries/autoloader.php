<?php
/**
 * Carega automaticamente as classes Core
 * @param string $name
 * @return null
 */
function autoLoader($name){
    $file = APPLICATIONPATH . '/core/'.$name. '.php';
    $file2 = APPLICATIONPATH . '/core/interfaces/'.$name. '.php';
    $file3 = APPLICATIONPATH . '/core/util/'.$name. '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    if (file_exists($file2)) {
        require_once $file2;
        return;
    }
    if (file_exists($file3)) {
        require_once $file3;
        return;
    }
    require_once APPLICATIONPATH . '/views/includes/404.php';
}
spl_autoload_register('autoloader');
