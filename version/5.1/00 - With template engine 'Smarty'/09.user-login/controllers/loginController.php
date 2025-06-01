<?php
    class loginController extends Controller {

        private $_login;

        public function __construct() {
            parent::__construct();
            $this->_login = $this->loadModel('login');
        }

        public function index() {
            $this->_view->titulo = 'Iniciar Sesión';

            if($this->getInt('enviar') == 1) {
                $this->_view->datos = $_POST;

                if(!$this->getAlphaNum('usuario')) {
                    $this->_view->_error = 'Debe introducir su nombre de usuario.';
                    $this->_view->renderizar('index', 'login');
                    exit;
                }

                if(!$this->getSql('pass')) {
                    $this->_view->_error = 'Debe introducir su password.';
                    $this->_view->renderizar('index', 'login');
                    exit;
                }

                $row = $this->_login->getUsuario($this->getAlphaNum('usuario'), $this->getSql('pass'));

                if(!$row) {
                    $this->_view->_error = 'Usuario y/o password incorrectos.';
                    $this->_view->renderizar('index', 'login');
                    exit;
                }

                if($row['estado'] != 1) {
                    $this->_view->_error = 'Este usuario no está habilitado.';
                    $this->_view->renderizar('index', 'login');
                    exit;
                }

                Session::set('autenticado', true);
                Session::set('id_usuario', $row['id']);
                Session::set('usuario', $row['usuario']);
                Session::set('level', $row['rol']);
                Session::set('tiempo', time());

                // print_r($_SESSION);

                $this->redireccionar();
            }

            $this->_view->renderizar('index', 'login');
        }

        public function cerrar() {
            Session::destroy(array('var1', 'var2'));
            $this->redireccionar('login/mostrar');
        }
    }
?>