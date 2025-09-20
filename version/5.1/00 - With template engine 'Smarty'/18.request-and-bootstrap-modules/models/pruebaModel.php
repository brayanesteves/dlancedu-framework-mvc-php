<?php
    class pruebaModel extends Model {
        public function __construct() {
            parent::__construct();
        }

        public function getPruebas() {
            $prueba = $this->_db->query("SELECT * FROM prueba;");
            return $prueba->fetchall();
        }

        public function insertarPrueba($nombre) {
            $this->_db->prepare("INSERT INTO `prueba` VALUES(null, :nombre);")->execute(array(':nombre' => $nombre));
        }
    }
?>