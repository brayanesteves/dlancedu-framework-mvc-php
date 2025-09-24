<?php
    class registroModel extends Model {
        public function __construct() {
            parent::__construct();
        }

        public function verificarUsuario($usuario) {
            $id = $this->_db->query("SELECT `id`, `codigo` FROM `usuarios` WHERE `usuario` = '$usuario';");

            return $id->fetch();
        }

        public function verificarUsuarioSinElCampoCodigo($usuario) {
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
            $random = rand(1782598471, 9999999999);
            $this->_db->prepare("INSERT INTO `usuarios` VALUES (NULL, :nombre, :usuario, :password, :email, 'usuario', 0, NOW(), :codigo);")->execute(array(':nombre' => $nombre, ':usuario' => $usuario, ':password' => Hash::getHash('sha1', $password, HASH_KEY), ':email' => $email, ':codigo' => $random));
        }

        public function registrarUsuarioSinElCampoCodigo($nombre, $usuario, $password, $email) {
            $this->_db->prepare("INSERT INTO `usuarios` VALUES (NULL, :nombre, :usuario, :password, :email, 'usuario', 1, NOW());")->execute(array(':nombre' => $nombre, ':usuario' => $usuario, ':password' => Hash::getHash('sha1', $password, HASH_KEY), ':email' => $email));
        }

        public function getUsuario($id, $codigo) {
            $usuario = $this->_db->query("SELECT * FROM `usuarios` WHERE `id` = $id AND `codigo` = '$codigo';");
            return $usuario->fetch();
        }

        public function activarUsuario($id, $codigo) {
            $this->_db->query("UPDATE `usuarios` SET `estado` = 1 WHERE `id` = $id AND `codigo` = '$codigo';");
        }
    }
?>