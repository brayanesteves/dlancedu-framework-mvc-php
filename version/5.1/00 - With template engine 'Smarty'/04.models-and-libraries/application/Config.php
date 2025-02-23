<?php
    define('BASE_URL', 'http://localhost/mvc/');
    /**
     * [SPANISH]:
     * Esta constante significará el controlador por defecto de la aplicación.
     * En caso de que no se envíe ningún controlador en la URL, solicitará el controlador 'index'.
     * Y si queremos cambiar un valor por defecto, cambiamos los valores 'index'.
     * ==============
     * [ENGLISH]:
     * This constant will mean the default controller of the application
     * In case no controller is sent in the URL, it will request the 'index' controller
     * And if we want to change a default value, we change the 'index' values.
     */
    define('DEFAULT_CONTROLLER', 'index');
    /**
     * [SPANISH]:
     * La carpeta 'layout' que contiene el directorio 'views'.
     * ==============
     * [ENGLISH]:
     * The folder 'layout'  that directory 'views'.
     */
    define('DEFAULT_LAYOUT', 'default');

    define('APP_NAME', 'Mi Framework');
    define('APP_SLOGAN', 'mi primer framework php y mvc...');
    define('APP_COMPANY', 'www.dlancedu.com');

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'mvc');
    define('DB_CHAR', 'utf8');
?>