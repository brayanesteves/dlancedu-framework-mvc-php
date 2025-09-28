<?php
    class menuModelWidget extends Model {

        public function __construct() {
            parent::__construct();
        }

        public function getMenu() {
            return array(
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
        }

    }
?>