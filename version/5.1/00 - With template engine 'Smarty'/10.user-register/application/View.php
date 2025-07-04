<?php
    class View {

        private $_controlador;
        private $_js;

        public function __construct(Request $peticion) {
            $this->_controlador = $peticion->getControlador();
            $this->_js          = array();
        }

        public function renderizar($vista, $item = false) {

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
                'js'       => $js,
            );

            $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';

            if(is_readable($rutaView)) {
                include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
                include_once $rutaView;
                include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
            } else {
                throw new Exception('Error de vista.');
            }
        }

        public function setJs(array $js) {
            if(is_array($js) && count($js)) {
                for($i = 0; $i < count($js); $i++) {
                    $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
                }
            } else {
                throw new Exception('Error de js.');
            }
        }

    }
?>