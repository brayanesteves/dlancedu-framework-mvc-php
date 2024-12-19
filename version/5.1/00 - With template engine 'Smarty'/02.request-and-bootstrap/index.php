<?php
    // echo $_GET['url'];

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', realpath(dirname(__FILE__)) . DS);
    define('APP_PATH', ROOT . 'application' . DS);

    // echo ROOT;

    require_once APP_PATH . 'Config.php';
    require_once APP_PATH . 'Request.php';
    require_once APP_PATH . 'Bootstrap.php';
    require_once APP_PATH . 'Controller.php';
    require_once APP_PATH . 'Model.php';
    require_once APP_PATH . 'View.php';
    require_once APP_PATH . 'Registro.php';


    // =============================== //
    //          Test 'Files'           //
    // =============================== //

    /**
     * echo '<pre>';
     * print_r(get_required_files());
     * echo '</pre>';
     */

    // =============================== //
    //        Test 'Request.php'       //
    // =============================== //
    /**
     * Test 'Request.php' directory[Folder] 'application': 
     * Test Nº0:
     * http://localhost/mvc-phpv7/controlller////method/arguments
     * 
     * Result:
     * 
     * controlller
     * method
     * 
     * Array
     * (
     *     [0] => arguments
     * )
     * 
     * Test Nº1
     * http://localhost/mvc-phpv7/controlller////method/arguments/test0/test1/test2
     * 
     * Result:
     * 
     * controlller
     * method
     * 
     * Array
     * (
     *     [0] => arguments
     *     [1] => test0
     *     [2] => test1
     *     [3] => test2
     * )
     */
    //$r = new Request();
    //echo $r->getControlador() . '<br />';
    //echo $r->getMetodo() . '<pre>';
    //print_r($r->getArgs());
    //echo '</pre>';

    try {        
        // =============================== //
        //       'Bootstrap.php'      //
        // =============================== //
        Bootstrap::run(new Request);

    } catch(Exception $e) {
        echo $e->getMessage();
    }

?>