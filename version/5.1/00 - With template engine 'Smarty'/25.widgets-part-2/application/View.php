<?php

    require_once ROOT . 'libs' . DS . 'smarty/version/3.1.8' . DS . 'libs' . DS . 'Smarty.class.php';

    class View extends Smarty {

        private $_controlador; // @Deprecated
        private $_request;
        private $_js;
        private $_acl;
        private $_rutas;
        private $_jsPlugin;
        private $_template;
        private $_item;

        public function __construct(Request $peticion, ACL $_acl) {
            parent::__construct();
            // $this->_controlador = $peticion->getControlador(); // @Deprecated
            $this->_request  = $peticion;
            $this->_js       = array();
            $this->_acl      = $_acl;
            $this->_rutas    = array();
            $this->_jsPlugin = array();
            $this->_template = DEFAULT_LAYOUT;
            $this->_item     = '';

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

        public function renderizar($vista, $item = false, $noLayout = false) {
            
            if($item) {
                $this->_item = $item;
            }

            // print_r($this->getWidgets()); exit;
            // print_r($this->getLayoutPositions()); exit;

            // $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS; // @Deprecated
            $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . $this->_template . DS;
            // $this->config_dir   = ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'configs' . DS; // @Deprecated
            $this->config_dir   = ROOT . 'views' . DS . 'layout' . DS . $this->_template . DS . 'configs' . DS;
            $this->cache_dir    = ROOT . 'tmp' . DS . 'cache' . DS;
            $this->compile_dir  = ROOT . 'tmp' . DS . 'template' . DS;

            $menu = array(
                array(
                    'id'     => 'inicio',
                    'titulo' => 'Inicio',
                    'enlace' => BASE_URL,
                    'icon'   => 'icon-home',
                ),

                array(
                    'id'     => 'post',
                    'titulo' => 'Post',
                    'enlace' => BASE_URL . 'post',
                    'icon'   => 'icon-flag',
                ),

                array(
                    'id'     => 'hola',
                    'titulo' => 'Hola',
                    'enlace' => BASE_URL . 'hola',
                    'icon'   => '',
                )
            );

            if(Session::get('autenticado')) {
                $menu[] = array(
                    'id'     => 'login',
                    'titulo' => 'Cerrar Sesión',
                    'enlace' => BASE_URL . 'login/cerrar',
                    'icon'   => '',
                );
            } else {
                $menu[] = array(
                    'id'     => 'login',
                    'titulo' => 'Iniciar Sesión',
                    'enlace' => BASE_URL . 'login',
                    'icon'   => '',
                );

                $menu[] = array(
                    'id'     => 'registro',
                    'titulo' => 'Registro',
                    'enlace' => BASE_URL . 'registro',
                    'icon'   => 'icon-book',
                );
            }            

            $js = array();

            if(count($this->_js)) {
                $js = $this->_js;
            }

            $_layoutParams = array(
                // 'ruta_css'   => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',  // @Deprecated
                'ruta_css'   => BASE_URL . 'views/layout/' . $this->_template . '/css/',
                // 'ruta_img'   => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/', // @Deprecated
                'ruta_img'   => BASE_URL . 'views/layout/' . $this->_template . '/img/',
                // 'ruta_js'    => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/', // @Deprecated
                'ruta_js'    => BASE_URL . 'views/layout/' . $this->_template . '/js/',
                'menu'       => $menu,
                // 'item'       => $item, // @Deprecated
                'item'       => $this->_item,
                'js'         => $js,
                'root'       => BASE_URL,
                'js_plugin'  => $this->_jsPlugin,
                'configs'    => array(
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
                if($noLayout) {
                    $this->template_dir = $this->_rutas['view'];
                    $this->display($this->_rutas['view'] . $vista . '.tpl');
                    exit;
                }
                $this->assign('_contenido', $this->_rutas['view'] . $vista . '.tpl');
            } else {
                throw new Exception('Error de vista.');
            }
            
            $this->assign('widgets', $this->getWidgets());
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

        public function setJsPlugin(array $js) {
            if(is_array($js) && count($js)) {
                for($i = 0; $i < count($js); $i++) {
                    $this->_jsPlugin[] = BASE_URL . 'public/js/' . $js[$i] . '.js';
                }
            } else {
                throw new Exception('Error de js Plugin.');
            }
        }

        public function setTemplate($template) {
            $this->_template = (string) $template;
        }

        public function widget($widget, $method, $options = array()) {
            if(!is_array($options)) {
                $options = array($options);
            }

            if(is_readable(ROOT . 'widgets' . DS . $widget . '.php')) {
                include_once ROOT . 'widgets' . DS . $widget . '.php';
                $widgetClass = $widget . 'Widget';

                if(!class_exists($widgetClass)) {
                    throw new Exception('Error de clase de widget.');                    
                }

                if(is_callable(array($widgetClass, $method))) {
                    if(count($options)) {
                        return call_user_func_array(array(new $widgetClass, $method), $options);
                    } else {
                        return call_user_func(array(new $widgetClass, $method));
                    }
                }
                throw new Exception('Error de metodo de widget.');
            }

            throw new Exception('Error de widget.');
        }

        public function getLayoutPositions() {
            if(is_readable(ROOT . 'views' . DS.  'layout' . DS . $this->_template . DS .'configs.php')) {
                include_once ROOT . 'views' . DS.  'layout' . DS . $this->_template . DS .'configs.php';

                return get_layout_positions();

            }
            throw new Exception('Error de configuracion de layout.');
        }

        public function getWidgets() {
            $widgets = array(
                'menu-sidebar' => array(
                    'config'  => $this->widget('menu', 'getConfig'),
                    'content' => $this->widget('menu', 'getMenu'),
                ),
            );

            $positions = $this->getLayoutPositions();
            $keys = array_keys($widgets);

            foreach($keys as $k) {
                /**
                 * [SPANISH]
                 * Verificar si la posición del widget está present.
                 */
                if(isset($positions[$widgets[$k]['config']['position']])) {
                    /**
                     * [SPANISH]
                     * Verificar si está deshabilitado a la vista.
                     */
                    if(!isset($widgets[$k]['config']['hide']) || !in_array($this->_item, $widgets[$k]['config']['hide'])) {
                        /**
                         * [SPANISH]
                         * Verificar. Si está habilitado a la vista.
                         */
                        if($widgets[$k]['config']['show'] === 'all' || in_array($this->_item, $widgets[$k]['config']['show'])) {
                            /**
                             * [SPANISH]
                             * Llenar la posición del 'layout'
                             */
                            $positions[$widgets[$k]['config']['position']][] = $this->getWidgetContent($widgets[$k]['content']);
                        }
                        
                    }
                } 
            }
            return $positions;
        }

        public function getWidgetContent(array $content) {
            if(!isset($content[0]) || empty($content[1])) {
                throw new Exception('Error de contenido de widget.');
                return;
            }

            if(isset($content[2])) {
                $content[2] = array();
            }

            return $this->widget($content[0], $content[1], $content[2]);
        }

    }
?>