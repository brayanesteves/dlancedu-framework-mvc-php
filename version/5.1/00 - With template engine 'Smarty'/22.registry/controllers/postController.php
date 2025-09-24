<?php
    class postController extends Controller {

        private $_post;

        public function __construct() {
            parent::__construct();
            $this->_post = $this->loadModel('post');
        }

        public function index($pagina = false) {   

            if(!$this->filtrarInt($pagina)) {
                $pagina = false;
            } else {
                $pagina = (int) $pagina;
            }

            $this->getLibrary('dlancedu-paginator-library-php-modify-framework-mvc/paginador');         
            $paginador = new Paginador();

            $this->_view->assign("posts", $paginador->paginar($this->_post->getPosts(), $pagina));
            $this->_view->assign("paginacion", $paginador->getView('prueba', 'post/index'));
            $this->_view->assign("titulo", 'Portada');
            $this->_view->setJs(array('main'));
            $this->_view->renderizar('index', 'post');
        }

        public function paginadorprueba($pagina = false) {   

            /*if(!$this->filtrarInt($pagina)) {
                $pagina = false;
            } else {
                $pagina = (int) $pagina;
            }*/

            $this->getLibrary('dlancedu-paginator-library-php-modify-framework-mvc/paginador');         
            $paginador = new Paginador();

            $ajaxModel = $this->loadModel('ajax');
            $this->_view->setJs(array('main', 'paginacion_ajax'));
            $this->_view->assign("paises", $ajaxModel->getPaises());
            $this->_view->assign("posts", $paginador->paginar($this->_post->getPosts()));
            $this->_view->assign("paginacion", $paginador->getView('paginacion_ajax'));
            $this->_view->assign("titulo", 'Portada');
            $this->_view->renderizar('prueba', 'post');
        }

        public function insertarpostsmock() {
            for($i = 0; $i < 300; $i++) {
                $model = $this->loadModel('post');
                $model->insertarPost('Titulo ' . $i, 'Cuerpo ' . $i);
            }
        }

        public function pruebaAjax() {
            $pagina = $this->getInt('pagina');
            $nombre = $this->getSql('nombre');
            $pais = $this->getInt('pais');
            $ciudad = $this->getInt('ciudad');
            $registros = $this->getInt('registros');
            $condicion = "";

            if($nombre) {
                $condicion = " AND `nombre` LIKE '%$nombre%' ";
            }

            if($pais) {
                $condicion .= " AND `id_pais` = $pais ";
            }

            if($ciudad) {
                $condicion .= " AND `id_ciudad` = $ciudad ";
            }

            $this->getLibrary('dlancedu-paginator-library-php-modify-framework-mvc/paginador');         
            $paginador = new Paginador();

            $this->_view->setJs(array('paginacion_ajax'));
            $this->_view->assign("posts", $paginador->paginar($this->_post->getPruebaN1($condicion), $pagina, $registros));
            $this->_view->assign("paginacion", $paginador->getView('paginacion_ajax'));
            /**
             * [ENGLISH]
             * ===============
             * [SPANISH]
             * Viene de '\views\post\assets\ajax\prueba.tpl'
             */
            $this->_view->renderizar('ajax/prueba', false, true);
        }

        public function nuevo() {

            // Session::accesoEstricto(array('usuario'));
            $this->_acl->acceso('nuevo_post');

            $this->_view->assign("titulo", 'Nuevo Post');
            $this->_view->setJsPlugin(array('jquery.validate'));
            $this->_view->setJs(array('nuevo'));

            if($this->getInt('guardar') == 1) {

                $this->_view->datos = $_POST;

                if(!$this->getTexto('titulo')) {
                    $this->_view->_error = 'Debe introducir el titulo del post';
                    $this->_view->renderizar('nuevo', 'post');
                    exit;
                }

                if(!$this->getTexto('cuerpo')) {
                    $this->_view->_error = 'Debe introducir el cuerpo del post';
                    $this->_view->renderizar('nuevo', 'post');
                    exit;
                }

                $imagen = '';
                if(isset($_FILES['imagen']['name'])) {
                    $this->getLibrary('upload.class' . DS . 'version' . DS . '0.31' . DS . 'class.upload');
                    $ruta = ROOT . 'public' . DS . 'img' . DS . 'post' . DS;
                    $upload = new Upload($_FILES['imagen']);
                    $upload->allowed = array('image/*');
                    $upload->file_new_name_body = 'upl_' . uniqid();
                    $upload->process($ruta);

                    if($upload->processed) {
                        $imagen = $upload->file_dst_name;
                        $thumb = new Upload($upload->file_dst_pathname);
                        $thumb->image_resize = true;
                        $thumb->image_x = 100;
                        $thumb->image_y = 70;
                        $thumb->file_name_body_pre = 'thumb_';
                        $thumb->process($ruta . 'thumb' . DS);
                    } else {
                        $this->_view->assign('_error', $upload->error);
                        $this->_view->renderizar('nuevo', 'post');
                        exit;
                    }
                    
                }

                // $this->_post->insertarPost($this->getTexto('titulo'), $this->getTexto('cuerpo'));
                $this->_post->insertarPost($this->getPostParam('titulo'), $this->getPostParam('cuerpo'), $imagen);
                $this->redireccionar('post');
            }
            $this->_view->renderizar('nuevo', 'post');
        }

        public function editar($id) {
            $this->_acl->acceso('editar_post');
            if(!$this->filtrarInt($id)) {
                $this->redireccionar('post');
            }

            if(!$this->_post->getPost(!$this->filtrarInt($id))) {
                $this->redireccionar('post');
            }

            $this->_view->assign("titulo", 'Editar Post');
            $this->_view->setJs(array('nuevo'));

            if($this->getInt('guardar') == 1) {

                $this->_view->datos = $_POST;

                if(!$this->getTexto('titulo')) {
                    $this->_view->assign("_error", 'Debe introducir el titulo del post');
                    $this->_view->renderizar('editar', 'post');
                    exit;
                }

                if(!$this->getTexto('cuerpo')) {
                    $this->_view->assign("_error", 'Debe introducir el cuerpo del post');
                    $this->_view->renderizar('editar', 'post');
                    exit;
                }

                $this->_post->editarPost($this->filtrarInt($id), $this->getTexto('titulo'), $this->getTexto('cuerpo'));
                $this->redireccionar('post');
            }

            $this->_view->datos = $this->_post->getPost(!$this->filtrarInt($id));
            $this->_view->renderizar('editar', 'post');
        }

        public function eliminar($id) {
            $this->_acl->acceso('eliminar_post');

            Session::acceso('admin');

            if(!$this->filtrarInt($id)) {
                $this->redireccionar('post');
            }

            if(!$this->_post->getPost(!$this->filtrarInt($id))) {
                $this->redireccionar('post');
            }

            $this->_post->eliminarPost($this->filtrarInt($id));
            $this->redireccionar('post');
        }

        public function test() {
            $this->_view->assign("posts", $this->_post->getPostsMock());
            // echo 'Hola desde el indexController... ';
            $this->_view->assign("titulo", '[Test] Portada');
            // $this->_view->renderizar('index');
            $this->_view->renderizar('test', 'post');
        }

        public function nuevotest() {
            $this->_view->assign("titulo", 'Nuevo Post');
            $this->_view->setJs(array('nuevotest'));
            $this->_view->assign("prueba", $this->getTexto('titulo'));
            $this->_view->assign("prueba_getInt", $this->getInt('guardar'));
            $this->_view->renderizar('nuevotest', 'post', true);
        }
    }
?>