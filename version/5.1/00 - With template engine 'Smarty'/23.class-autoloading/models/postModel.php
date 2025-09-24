<?php
    class postModel extends Model {
        public function __construct() {
            parent::__construct();
        }

        public function getPosts() {
            $post = $this->_db->query("SELECT * FROM posts;");
            return $post->fetchall();
        }

        public function getPost($id) {
            $id = (int) $id;
            $post = $this->_db->query("SELECT * FROM posts WHERE id = $id;");
            return $post->fetch();
        }

        public function insertarPost($titulo, $cuerpo, $imagen) {
            $this->_db->prepare("INSERT INTO `posts` VALUES(null, :titulo, :cuerpo, :imagen);")->execute(array(':titulo' => $titulo, ':cuerpo' => $cuerpo, ':imnagen' => $imagen));
        }

        public function editarPost($id, $titulo, $cuerpo) {
            $id = (int) $id;
            $this->_db->prepare("UPDATE `posts` SET `titulo` = :titulo, `cuerpo` = :cuerpo) WHERE `id` = :id;")->execute(array(':id' => $id, ':titulo' => $titulo, ':cuerpo' => $cuerpo));
        }

        public function eliminarPost($id) {
            $id = (int) $id;
            $this->_db->prepare("DELETE FROM `posts` WHERE `id` = :id;")->execute(array(':id' => $id));
        }

        public function getPostsMock() {
            $post = array(
                'id' => 1,
                'titulo' => 'Titulo Post',
                'cuerpo' => 'Cuerpo Post...'
            );

            return $post;
        }

        public function insertarPrueba($nombre) {
            $this->_db->prepare("INSERT INTO `prueba` VALUES(null, :nombre);")->execute(array(':nombre' => $nombre));
        }

        public function getPruebaN0() {
            $post = $this->_db->query("SELECT * FROM `prueba`;");
            return $post->fetchAll();
        }

        public function getPruebaN1($condicion = "") {
            $post = $this->_db->query("SELECT `r`.*, `p`.`pais`, `c`.`ciudad` FROM `prueba` `r`, `paises` `p`, `ciudades` `c` WHERE `r`.`id_pais` = `p`.`id` AND `r`.`id_ciudad` = `c`.`id` $condicion ORDER BY `id` ASC;");
            return $post->fetchAll();
        }
    }
?>