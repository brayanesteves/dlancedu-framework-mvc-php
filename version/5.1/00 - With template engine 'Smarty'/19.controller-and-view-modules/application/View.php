<?php

    require_once ROOT . 'libs' . DS . 'smarty/version/3.1.8' . DS . 'libs' . DS . 'Smarty.class.php';

    class View extends Smarty {

        private $_controlador; // @Deprecated
        private $_request;
        private $_js;
        private $_acl;
        private $_rutas;

        public function __construct(Request $peticion, ACL $_acl) {
            parent::__construct();
            // $this->_controlador = $peticion->getControlador(); // @Deprecated
            $this->_request = $peticion;
            $this->_js          = array();
            $this->_acl         = $_acl;
            $this->_rutas       = array();

            $modulo = $this->_request->getModulo();
            $controlador = $this->_request->getControlador();

            if($modulo) {
                $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
                $this->_rutas['js']   = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/';
            } else {
                $this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
                $this->_rutas['js']   = BASE_URL . 'views/' . $controlador . '/js/';
            }
        }

        public function renderizar($vista, $item = false) {

            $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS;
            $this->config_dir   = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'configs' . DS;
            $this->cache_dir    = ROOT . 'tmp' . DS . 'cache' . DS;
            $this->compile_dir  = ROOT . 'tmp' . DS . 'template' . DS;

            $menu = array(
                array(
                    'id'     => 'inicio',
                    'titulo' => 'Inicio',
                    'enlace' => BASE_URL,
                ),

                array(
                    'id'     => 'post',
                    'titulo' => 'Post',
                    'enlace' => BASE_URL . 'post',
                ),

                array(
                    'id'     => 'hola',
                    'titulo' => 'Hola',
                    'enlace' => BASE_URL . 'hola',
                )
            );

            if(Session::get('autenticado')) {
                $menu[] = array(
                    'id'     => 'login',
                    'titulo' => 'Cerrar Sesión',
                    'enlace' => BASE_URL . 'login/cerrar',
                );
            } else {
                $menu[] = array(
                    'id'     => 'login',
                    'titulo' => 'Iniciar Sesión',
                    'enlace' => BASE_URL . 'login',
                );

                $menu[] = array(
                    'id'     => 'registro',
                    'titulo' => 'Registro',
                    'enlace' => BASE_URL . 'registro',
                );
            }

            $js = array();

            if(count($this->_js)) {
                $js = $this->_js;
            }

            $_layoutParams = array(
                'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
                'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
                'ruta_js'  => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
                'menu'     => $menu,
                'item'     => $item,
                'js'       => $js,
                'root'     => BASE_URL,
                'configs'  => array(
                    'app_name'    => APP_NAME,
                    'app_slogan'  => APP_SLOGAN,
                    'app_company' => APP_COMPANY,
                ),
            );

            // $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
            // $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.tpl';  // @Deprecated

            // if(is_readable($rutaView)) {
            //     $this->assign('_contenido', $rutaView);
            // } else {
            //     throw new Exception('Error de vista.');
            // }

            // =============================== //
            //              Test               //
            // =============================== //
            // echo '<pre>'; print_r($this->_rutas); echo '</pre>';
            // exit;
            // =============================== //

            if(is_readable($this->_rutas['view'] . $vista . '.tpl')) {
                $this->assign('_contenido', $this->_rutas['view'] . $vista . '.tpl');
            } else {
                throw new Exception('Error de vista.');
            }

            $this->assign('_acl', $this->_acl);
            $this->assign('_layoutParams', $_layoutParams);
            $this->display('template.tpl');
        }

        public function setJs(array $js) {
            if(is_array($js) && count($js)) {
                for($i = 0; $i < count($js); $i++) {
                    $this->_js[] = $this->_rutas['js'] . $js[$i] . '.js';
                }
            } else {
                throw new Exception('Error de js.');
            }
        }

    }
?>