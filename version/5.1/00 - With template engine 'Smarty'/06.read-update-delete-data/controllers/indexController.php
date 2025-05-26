<?php
    class indexController extends Controller {

        public function __construct() {
            parent::__construct();
        }

        public function index() {
            $post                = $this->loadModel('post');
            $this->_view->posts  = $post->getPosts();
            // echo 'Hola desde el indexController... ';
            $this->_view->titulo = 'Portada';
            // $this->_view->renderizar('index');
            $this->_view->renderizar('index', 'inicio');
        }

        public function test() {
            $post                = $this->loadModel('post');
            $this->_view->posts  = $post->getPostsMock();
            // echo 'Hola desde el indexController... ';
            $this->_view->titulo = 'Portada';
            // $this->_view->renderizar('index');
            $this->_view->renderizar('test', 'inicio');
        }
    }
?>