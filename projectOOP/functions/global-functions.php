<?php
function ___autoload($class_name) {
    $file = ABSPATH . '/classes/class-' . $class_name . '.php';
    if(!file_exists($file)) {
        require_once ABSPATH . '/404.php';
        return;
    }
    require_once $file;
}

?>