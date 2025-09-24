<?php
    class Bootstrap {
        public static function run(Request $peticion) {

            $modulo = $peticion->getModulo();

            $controller      = $peticion->getControlador() . 'Controller';
            $metodo          = $peticion->getMetodo();
            $args            = $peticion->getArgs();

            // =============================== //
            //              Test               //
            // =============================== //
            // echo $rutaControlador;
            // exit;
            // =============================== //

            /**
             * [SPANISH]
             * Si ahi un controlador base para ese modulo.
             * El prop´´osito del controlador base del módulo, es que proporcione código para el modulo completo.
             * Y ya los controladores dentro del módulo, hereden de este controlador base. (Por ejemplo: 'usuarioController.php' y no de Controller, si 'usuarioController.php' si va a heredar de 'Controller.php').
             */
            if($modulo) {
                $rutaModulo = ROOT . 'controllers' . DS . $modulo . DS . 'Controller' . '.php';
                if(is_readable($rutaModulo)) {
                    require_once $rutaModulo;
                    $rutaControlador = ROOT . 'modules' . DS . $modulo . DS . 'controllers' . DS . $controller . '.php';
                } else {
                    throw new Exception('Error de base de modulo.');
                }
            } else {
                $rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';
            }

            // =============================== //
            //              Test               //
            // =============================== //
            // echo $rutaControlador;
            // exit;
            // =============================== //

            if(is_readable($rutaControlador)) {
                require_once $rutaControlador;
                $controller = new $controller;

                if(is_callable(array($controller, $metodo))) {
                    $metodo = $peticion->getMetodo();
                } else {
                    $metodo = 'index';
                }

                if(isset($args)) {
                    call_user_func_array(array($controller, $metodo), $args);
                } else {
                    call_user_func(array($controller, $metodo));
                }
            } else {
                throw new Exception('No encontrado.');
            }
        }
    }
?>