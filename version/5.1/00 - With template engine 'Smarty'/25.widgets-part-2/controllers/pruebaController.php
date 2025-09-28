<?php
    class pruebaController extends Controller {

        private $_prueba;

        public function __construct() {
            parent::__construct();
            $this->_post = $this->loadModel('prueba');
        }

        public function index($pagina = false) {   

            if(!$this->filtrarInt($pagina)) {
                $pagina = false;
            } else {
                $pagina = (int) $pagina;
            }

            $this->getLibrary('dlancedu-paginator-library-php-modify-framework-mvc/paginador');         
            $paginador = new Paginador();

            $this->_view->pruebas  = $paginador->paginar($this->_prueba->getPruebas(), $pagina);
            $this->_view->paginacion = $paginador->getView('prueba', 'prueba/index');
            $this->_view->titulo = 'Zona de pruebas';
            $this->_view->renderizar('index', 'prueba');
        }

        public function insertarpruebasmock() {
            for($i = 0; $i < 300; $i++) {
                $model = $this->loadModel('prueba');
                $model->insertarPrueba('Nombre ' . $i);
            }
        }
    }
?>