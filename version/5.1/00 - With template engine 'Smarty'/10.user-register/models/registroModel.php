<?php
    class registroModel extends Model {
        public function __construct() {
            parent::__construct();
        }

        public function verificarUsuario($usuario) {
            $id = $this->_db->query("SELECT `id` FROM `usuarios` WHERE `usuario` = '$usuario';");

            if($id->fetch()) {
                return true;
            }

            return false;
        }

        public function verificarEmail($email) {
            $id = $this->_db->query("SELECT `id` FROM `usuarios` WHERE `email` = '$email';");

            if($id->fetch()) {
                return true;
            }

            return false;
        }

        public function registrarUsuario($nombre, $usuario, $password, $email) {
            $this->_db->prepare("INSERT INTO `usuarios` VALUES (NULL, :nombre, :usuario, :password, :email, 'usuario', 1, NOW());")->execute(array(':nombre' => $nombre, ':usuario' => $usuario, ':password' => Hash::getHash('sha1', $password, HASH_KEY), ':email' => $email));
        }
    }
?>