<?php
    class aclController extends Controller {

        private $_aclm;

        public function __construct() {
            parent::__construct();
            $this->_aclm = $this->loadModel('acl');
        }

        public function index() {    
            $this->_view->assign("titulo", 'Listas de Control de Acceso (ACL)');
            $this->_view->renderizar('index');
        }

        public function roles() {
            $this->_view->assign("titulo", 'Administración de roles');
            $this->_view->assign("roles", $this->_aclm->getRoles());
            $this->_view->renderizar('roles');
        }

        public function permisos_role($roleID) {
            $id = $this->filtrarInt($roleID);

            if(!$id) {
                $this->redireccionar('acl/roles');
            }

            $row = $this->_aclm->getRole($id);

            if(!$row) {
                $this->redireccionar('acl/roles');
            }

            $this->_view->assign("titulo", 'Administración de permisos roles');

            if($this->getInt('guardar') == 1) {
                $values = array_keys($_POST);
                $replace = array();
                $eliminar = array();

                for($i = 0; $i < count($values); $i++) {
                    if(substr($values[$i], 0, 5) == 'perm_') {
                        if($_POST[$values[$i]] == 'x') {
                            $eliminar[] = array(
                                'role'    => $id,
                                'permiso' => substr($values[$i], -1)
                            );
                        } else {
                            if($_POST[$values[$i]] == 1) {
                                $v = 1;
                            } else {
                                $v = 0;
                            }
                            $replace[] = array(
                                'role'    => $id,
                                'permiso' => substr($values[$i], -1),
                                'valor'   => $v
                            );
                        }
                    }
                }

                for($i = 0; $i < count($eliminar); $i++) {
                    $this->_aclm->eliminarPermisoRole($eliminar[$i]['role'], $eliminar[$i]['permiso']);
                }

                for($i = 0; $i < count($replace); $i++) {
                    $this->_aclm->editarPermisoRole($replace[$i]['role'], $replace[$i]['permiso'], $replace[$i]['valor']);
                }
            }

            $this->_view->assign('role', $row);
            $this->_view->assign('permisos', $this->_aclm->getPermisosRole($id));
            $this->_view->renderizar('permisos_role');
        }
    }
?>