<?php
    class registroController extends Controller {
        private $_registro;

        public function __construct() {
            parent::__construct();

            $this->_registro = $this->loadModel('registro');
        }

        public function index() {
            if(Session::get('autenticado')) {
                $this->redireccionar();
            }

            $this->_view->titulo = 'Registro';

            if($this->getInt('enviar') == 1) {
                $this->_view->datos = $_POST;

                if(!$this->getSql('nombre')) {
                    $this->_view->_error = 'Debe introducir su nombre.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                if(!$this->getAlphaNum('usuario')) {
                    $this->_view->_error = 'Debe introducir su nombre de usuario.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                if($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) {
                    $this->_view->_error = 'El usuario ' . $this->getAlphaNum('usuario') . ' ya existe.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                if(!$this->validarEmail($this->getPostParam('email'))) {
                    $this->_view->_error = 'La direccion email es inv&aacute;lida.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                if($this->_registro->verificarEmail($this->getPostParam('email'))) {
                    $this->_view->_error = 'Esta direccion de correo ya esta registrada.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                if(!$this->getSql('pass')) {
                    $this->_view->_error = 'Debe introducir su password.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                if($this->getPostParam('pass') != $this->getPostParam('confirmar'))  {
                    $this->_view->_error = 'Los passwords no coinciden.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }

                $this->_registro->regitrarUsuario($this->getSql('nombre'), $this->getAlphaNum('usuario'), $this->getPostParam('email'), $this->getSql('pass'));

                /**
                 * [ENGLISH]
                 * [SPANISH]
                 * Verifica si el usuario se ha registrado.
                 */
                if(!$this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) {
                    $this->_view->_error = 'Error al registrar el uusario.';
                    $this->_view->renderizar('index', 'registro');
                    exit;
                }
                $this->_view->datos = false;
                $this->_view->_mensaje = 'Registro completado.';
            }

            $this->_view->renderizar('index', 'registro');
        }
    }
?>