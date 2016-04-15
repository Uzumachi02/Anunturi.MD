<?php
function __autoload($class_name) {
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    foreach ($array_paths as $path) {

        $path = ENGINE_DIR . $path . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }
}