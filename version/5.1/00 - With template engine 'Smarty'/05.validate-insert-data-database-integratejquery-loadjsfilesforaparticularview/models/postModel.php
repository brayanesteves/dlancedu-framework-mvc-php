<?php
    class postModel extends Model {
        public function __construct() {
            parent::__construct();
        }

        public function getPosts() {
            $post = $this->_db->query("SELECT * FROM posts;");
            return $post->fetchall();
        }

        public function insertarPost($titulo, $cuerpo) {
            $this->_db->prepare("INSERT INTO `posts` VALUES(null, :titulo, :cuerpo);")->execute(array(':titulo' => $titulo, ':cuerpo' => $cuerpo));
        }

        public function getPostsMock() {
            $post = array(
                'id' => 1,
                'titulo' => 'Titulo Post',
                'cuerpo' => 'Cuerpo Post...'
            );

            return $post;
        }
    }
?>