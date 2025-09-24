<?php
    function autoloadCore($class) {
        if(file_exists(APP_PATH . ucfirst(strlower($class)) . '.php')) {
            // echo 'Llamando a la clase: ' . $class . '<br />';
            include_once APP_PATH . ucfirst(strlower($class)) . '.php';
        }
    }

    function autoloadLibs($class) {
        if(file_exists(ROOT . 'libs' . DS . strlower($class) . '.php')) {
            // echo 'Llamando a la clase: ' . $class . '<br />';
            include_once ROOT . 'libs' . DS . strlower($class) . '.php';
        }
    }

    function autoloadLibsWithPrefixClass($class) {
        if(file_exists(ROOT . 'libs' . DS . 'class.' . strlower($class) . '.php')) {
            // echo 'Llamando a la clase: ' . $class . '<br />';
            include_once ROOT . 'libs' . DS . 'class.' . strlower($class) . '.php';
        }
    }

    spl_autoload_register("autoloadCore");
    // spl_autoload_register("autoloadLibs");
    // spl_autoload_register("autoloadLibsWithPrefixClass");
?>