<?php
    class menuWidget extends Widget {

        private $modelo;

        public function __construct() {
            $this->modelo = $this->loadModel('menu');
        }

        public function menu() {
            $data['menu'] = $this->modelo->getMenu();
            return $this->render('menu-right', $data);
        }

        public function getConfig() {
            return array(
                'position'  => 'sidebar',
                'show'      => 'all',
                'showArray' => array('inicio', 'post'),
                'hide'      => array('registro', 'inicio'),
                'js'        => array('main'),
            );
        }

        public function menuMock() {
            $menuRight['menu'] = array(
                array(
                    'id'     => 'usuarios',
                    'titulo' => 'Usuarios',
                    'enlace' => BASE_URL . 'usuarios',
                    'icon'   => 'icon-user',
                ),
                array(
                    'id'     => 'acl',
                    'titulo' => 'Listas de control de acceso',
                    'enlace' => BASE_URL . 'registro',
                    'icon'   => 'icon-list-alt',
                ),
                array(
                    'id'     => 'ajax',
                    'titulo' => 'Ejemplo de uso de AJAX',
                    'enlace' => BASE_URL . 'ajax',
                    'icon'   => 'icon-refresh',
                ),
            );
            return $this->render('menu-right', $menuRight);
        }

    }
?>