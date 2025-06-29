<?php
    // echo $_GET['url'];

    ini_set('display_errors', 1);

    // Vulnerable 'md5'
    // echo md5('rrrrr'); exit; // Output: 6b76b5b54567ec0008287d11a2e9e22a

    // Create id unique
    // echo uniqid(); exit; // Output: 4f6a6d832be79

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', realpath(dirname(__FILE__)) . DS);
    define('APP_PATH', ROOT . 'application' . DS);

    // echo ROOT;

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

    // echo md5('1234'); exit; // 81dc9bdb52d04dc20036db8313ed055

    try {      
        
        require_once APP_PATH . 'Config.php';
        require_once APP_PATH . 'Request.php';
        require_once APP_PATH . 'Bootstrap.php';
        require_once APP_PATH . 'Controller.php';
        require_once APP_PATH . 'Model.php';
        require_once APP_PATH . 'View.php';
        require_once APP_PATH . 'Registro.php';
        require_once APP_PATH . 'Database.php';
        require_once APP_PATH . 'Session.php';
        require_once APP_PATH . 'Hash.php';

        // echo Hash::getHash('md5', 'tete', HASH_KEY); exit;  // Output: d8a0ee43f962e8a16354e69e678b4bb7
        // echo Hash::getHash('sha1', 'tete', HASH_KEY); exit; // Output: 70cb137d57f49cb3c298baa02f85c808cd33b0f6
        // echo Hash::getHash('sha1', '1234', HASH_KEY); exit; // Output: d1b254c9620425f582e27f0044be34bee087d8b4

        Session::init();

        // =============================== //
        //       'Bootstrap.php'      //
        // =============================== //
        Bootstrap::run(new Request);

    } catch(Exception $e) {
        echo $e->getMessage();
    }

?>