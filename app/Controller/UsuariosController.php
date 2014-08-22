<?php

App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
APP::uses('CakeEmail', 'Network/Email');

class UsuariosController extends AppController {

    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'alias' => 'asc'
        ),
        'fields' => array('id', 'alias', 'estado', 'role_id'),
        'conditions' => array('role_id' => array(1, 2))
    );

    public function registro() {
        $this->set('title_for_layout', 'Registro de Usuario');
        $this->layout = 'registro';
        if ($this->request->is('post')) {
            if ($this->request->data['Usuario']['contrasena'] == $this->request->data['Usuario']['rcontrasena']) {
                if ($this->Usuario->existeAlumno($this->request->data['Usuario']['alias'])) {
                    $this->Usuario->create();
                    $this->request->data['Usuario']['alias'] = strtoupper($this->request->data['Usuario']['alias']);
                    $this->request->data['Usuario']['role_id'] = 3;
                    $this->request->data['Usuario']['estado'] = 0;
                    if ($this->Usuario->save($this->request->data)) {
                        if ($this->Usuario->actualizarEstudiante($this->request->data['Usuario']['alias'], $this->Usuario->id)) {
                            $llave = substr(md5('SISTA' . $this->request->data['Usuario']['alias']), 0, 10);
                            $this->__enviar($this->request->data['Usuario']['correo'], $this->request->data['Usuario']['alias'], $llave);
                            $this->Session->setFlash(__('Se ha enviado una verificación a su correo, para continuar revisar el mismo.'), array('class' => 'OK'));
                            return $this->redirect('/');
                        } else {
                            $this->Session->setFlash(__('¡Ha ocurrido un error al registrar el usuario! , por favor intente de nuevo.'), array('class' => 'ERROR'));
                        }
                    } else {
                        $this->Session->setFlash(__('¡Ha ocurrido un error al registrar el usuario! , por favor intente de nuevo.'), array('class' => 'ERROR'));
                    }
                } else {
                    $this->Session->setFlash(__('El carnet ingresado no existe.'), array('class' => 'ALERT'));
                }
            } else
                $this->Session->setFlash(__('Las claves no coinciden.'), array('class' => 'ALERT'));
        }
    }

    public function login() {
        $this->set('title_for_layout', 'Iniciar Sesión');
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('estado') == 1) {
                    $this->loadModel('Menu');
                    $this->Session->write('menu', $this->Menu->getMenu($this->Auth->user('role_id')));
                    $this->redirect('/');
                } else if ($this->Auth->user('estado') == 2) {
                    $this->Auth->logout();
                    $this->Session->setFlash(__('Tu usuario ha sido suspendido.'), array('class' => 'ALERT'));
                } else {
                    $this->Auth->logout();
                    $this->Session->setFlash(__('Tu usuario no está activo, verifica tu cuenta de correo.'), array('class' => 'ALERT'));
                }
            } else {
                $this->Session->setFlash(__('Las credenciales ingresadas no son válidas'), array('class' => 'ALERT'));
            }
        }
    }

    public function logout() {
        $this->autoRender = false;
        $this->Auth->logout();
        $this->Session->delete('menu');
        $this->redirect('/');
    }

    private function __enviar($correo, $carnet, $llave) {
        $email = new CakeEmail('smtp');
        $email->to($correo);
        $email->subject('Registro de cuenta SiSTA – Verificación de correo.');
        $email->viewVars(array(
            'carnet' => $carnet,
            'llave' => $llave
        ));
        $email->helpers('Html');
        $email->template('activacion');
        $email->addAttachments(array(
            'logo5.png' => array(
                'file' => ROOT . '/app/webroot/img/logocorreo.png',
                'mimetype' => 'image/png',
                'contentId' => 'logo'
            )
        ));
        $email->send();
    }

    public function activar($carnet = null, $llave = NULL) {
        if ($carnet != NULL && $llave != NULL) {
            $this->set('title_for_layout', 'Activar Cuenta');
            $this->layout = 'login';
            if ($this->Usuario->existeAlumno($carnet)) {
                $this->Usuario->recursive = 0;
                $options = array('conditions' => array('alias' => $carnet, 'estado' => 0), 'fields' => array('id'));
                $usuario = $this->Usuario->find('first', $options);
                if (!empty($usuario)) {
                    $this->Usuario->id = $usuario['Usuario']['id'];
                    if ($this->Usuario->saveField('estado', 1)) {
                        $this->Session->setFlash('Tu cuenta ha sido activada, ahora puedes iniciar sesión.', array('class' => 'OK'));
                        return $this->redirect('/');
                    }
                    $this->Session->setFlash('Ocurrio un error en el proceso, por favor intente de nuevo.', array('class' => 'ERROR'));
                    return $this->redirect('/');
                }
                $this->Session->setFlash('Ocurrio un error en el proceso, por favor intente de nuevo.', array('class' => 'ERROR'));
                return $this->redirect('/');
            } else {
                $this->redirect('/');
            }
        } else {
            $this->redirect('/');
        }
    }

    public function index() {
        $this->Usuario->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('usuarios', $this->Paginator->paginate());
        $this->set('title_for_layout', 'Índice');
    }

    public function nuevo() {
        if ($this->request->is('post')) {
            $this->Usuario->create();
            $validador = $this->Usuario->validator();
            $validador['alias']['formato'] = array(
                'rule' => 'alphaNumeric',
            );
            $this->request->data['Usuario']['role_id'] = 2;
            $this->request->data['Usuario']['estado'] = 1;
            if ($this->Usuario->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('¡El usuario se ha guardado con éxito!'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('¡Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
            }
        }
        $catcargos = $this->Usuario->Empleado->Catcargo->find('list');
        $this->set(compact('catcargos'));
    }

    public function amd_contrasena($id = null) {
        if ($this->_md_contrasena($id)) {
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function umd_contrasena($id = null) {
        if (!empty($this->request->data)) {
            if ($this->request->data['Usuario']['contrasena'] == $this->request->data['Usuario']['n_contrasena']) {
                if ($this->_md_contrasena($id)) {
                    return $this->redirect(array('controller' => 'pages', 'action' => 'display', 'config'));
                }
            } else {
                $this->Session->setFlash(__('Las contraseñas no coinciden'), array('class' => 'ERROR'));
            }
        } else {
            $this->Usuario->recursive = 0;
            $options = array(
                'conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id),
                'fields' => array('id', 'alias')
            );
            $this->request->data = $this->Usuario->find('first', $options);
            $this->set('title_for_layout', 'Nueva Contraseña');
        }
    }

    private function _md_contrasena($id = null) {
        if (!$this->Usuario->exists($id)) {
            $this->Session->setFlash(__('Código de Usuario Inválido.'), array('class' => 'ERROR'));
        } else {
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Usuario->save($this->request->data)) {
                    $this->Session->setFlash(__('Se ha guardado la nueva contraseña con éxito'), array('class' => 'OK'));
                    return true;
                } else {
                    $this->Session->setFlash(__('Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'), array('class' => 'ERROR'));
                }
            } else {
                $this->Usuario->recursive = 0;
                $options = array(
                    'conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id),
                    'fields' => array('id', 'alias')
                );
                $this->request->data = $this->Usuario->find('first', $options);
            }
        }
        $this->set('title_for_layout', 'Nueva Contraseña');
    }

    public function md_estado($id = NULL) {
        if (!$this->Usuario->exists($id)) {
            $this->Session->setFlash(__('Código de Usuario Inválido.'), array('class' => 'ERROR'));
        } else
        if ($this->request->is(array('post', 'put'))) {
            $this->Usuario->id = $this->request->data['Usuario']['id'];
            if ($this->Usuario->saveField('estado', $this->request->data['Usuario']['estado'])) {
                $this->Session->setFlash(__('El cambio de estado se ha realizado con éxito'), array('class' => 'OK'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'));
            }
        } else {
            $this->Usuario->recursive = 0;
            $options = array(
                'conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id),
                'fields' => array('id', 'alias', 'estado')
            );
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $this->set('title_for_layout', 'Cambiar estado');
    }

    public function md_correo($id = NULL) {
        if (!$this->Usuario->exists($id)) {
            $this->Session->setFlash(__('ID de usuario invalido'), array('class' => 'ERROR'));
        } else
        if ($this->request->is(array('post', 'put'))) {
            $this->Usuario->id = $this->request->data['Usuario']['id'];
            $this->request->data['Usuario']['correo'] = $this->request->data['Usuario']['n_correo'];
            $this->Usuario->set($this->request->data);
            if ($this->Usuario->validates($this->request->data)) {
                $llave = substr(md5('SISTA' . $this->Session->read('Auth.User.alias') . $this->request->data['Usuario']['n_correo']), 0, 10);
                if ($this->__cambiocorreo($this->Session->read('Auth.User.correo'), $this->Session->read('Auth.User.alias'), $llave, $this->request->data['Usuario']['n_correo'])) {
                    $this->Session->setFlash(__('Se ha enviado un correo de confirmación'), array('class' => 'OK'));
                    $this->redirect(array('controller' => 'pages', 'action' => 'display', 'config'));
                } else {
                    $this->Session->setFlash(__('Ocurrio un error mientras se enviaba el correo de confirmación'), array('class' => 'ERROR'));
                }
            } else {
                $this->Session->setFlash(__('El correo tiene un formato no valido o ya esta en uso.'), array('class' => 'ERROR'));
            }
        } else {
            $this->Usuario->recursive = 0;
            $options = array(
                'conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id),
                'fields' => array('id', 'alias', 'correo')
            );
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $this->set('title_for_layout', 'Cambiar correo');
    }

    public function nuevo_correo($carnet = null, $correo = null, $llave = null) {
        $this->autoRender = false;
        $this->Auth->logout();
        $this->Session->delete('menu');
        if ($this->request->is('get')) {
            $key = substr(md5('SISTA' . $carnet . $correo), 0, 10);
            if ($llave == $key) {
                $this->Usuario->id = $this->Usuario->obtener_id($carnet);
                if ($this->Usuario->saveField('correo', $correo)) {
                    $this->Session->setFlash(__('El cambio de correo se ha realizado con éxito'), array('class' => 'OK'));
                    return $this->redirect(array('controller' => 'pages', 'action' => 'display', 'inicio'));
                } else {
                    $this->Session->setFlash(__('Ha ocurrido un error al guardar los datos! por favor intente de nuevo.'));
                }
            } else {
                $this->Session->setFlash(__('Ocurrio un error durante la validación de datos.'), array('class' => 'ERROR'));
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'inicio'));
            }
        }
    }

    private function __cambiocorreo($correo, $carnet, $llave, $ncorreo) {
        try {
            $email = new CakeEmail('smtp');
            $email->to($correo);
            $email->subject('SiSTA – Verificación de correo.');
            $email->viewVars(array(
                'carnet' => $carnet,
                'llave' => $llave,
                'correo' => $ncorreo
            ));
            $email->helpers('Html');
            $email->template('cambiocorreo');
            $email->addAttachments(array(
                'logo5.png' => array(
                    'file' => ROOT . '/app/webroot/img/logocorreo.png',
                    'mimetype' => 'image/png',
                    'contentId' => 'logo'
                )
            ));
            if ($email->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function recuperar_contrasena() {
        date_default_timezone_set('America/El_Salvador');
        $this->layout = 'registro';
        $this->set('title_for_layout', 'Recuperar Contraseña');
        if ($this->request->is('post')) {
            $this->Usuario->set($this->request->data);
            if ($this->Usuario->validates($this->request->data)) {
                if ($id = $this->Usuario->obtener_id_correo($this->request->data['Usuario']['v_correo'])) {
                    $key = substr(md5('SISTA' . $id . date('Y-m-d')), 0, 10);
                    if ($this->__correocontrasena($this->request->data['Usuario']['v_correo'], $id, $key)) {
                        $this->Session->setFlash(__('Se ha enviado una solicitud para cambio de contraseña a tu correo'), array('class' => 'OK'));
                        return $this->redirect(array('controller' => 'pages', 'action' => 'display', 'inicio'));
                    } else {
                        $this->Session->setFlash(__('Ocurrio un error al enviar la solicitud a tu correo'), array('class' => 'ERROR'));
                    }
                } else {
                    $this->Session->setFlash(__('Este correo no esta registrado en nuestra base de datos.'), array('class' => 'ALERT'));
                }
            }
        }
    }

    private function __correocontrasena($correo, $id, $llave) {
        try {
            $email = new CakeEmail('smtp');
            $email->to($correo);
            $email->subject('SiSTA – Solicitud para cambio de contraseña.');
            $email->viewVars(array(
                'id' => $id,
                'llave' => $llave,
            ));
            $email->helpers('Html');
            $email->template('recuperar');
            $email->addAttachments(array(
                'logo5.png' => array(
                    'file' => ROOT . '/app/webroot/img/logocorreo.png',
                    'mimetype' => 'image/png',
                    'contentId' => 'logo'
                )
            ));
            if ($email->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function cambiar_contrasena($id, $llave) {
        date_default_timezone_set('America/El_Salvador');
        $this->layout = 'registro';
        $this->set('title_for_layout', 'Cambiar Contraseña');
        $key = substr(md5('SISTA' . $id . date('Y-m-d')), 0, 10);
        if ($key == $llave) {
            if ($this->request->is('post')) {
                if ($this->request->data['Usuario']['contrasena'] == $this->request->data['Usuario']['r_contrasena']) {
                    $this->request->data['Usuario']['id'] = $id;
                    if ($this->_md_contrasena($id)) {
                        return $this->redirect(array('controller' => 'login'));
                    }
                } else {
                    $this->Session->setFlash(__('Las contraseñas no coinciden'), array('class' => 'ERROR'));
                }
            }
        } else {
            return $this->redirect(array('controller' => 'login'));
        }
    }

    public function acl() {
        $this->autoRender = false;
        $role = $this->Usuario->Role;
//---------------------------ESTUDIANTES------------------------
        $role->id = 3;
        $this->Acl->deny($role, 'controllers/Pages/display/catalogos');
        $this->Acl->allow($role, 'controllers/Pages/display/config');
        $this->Acl->allow($role, 'controllers/Usuarios/md_correo');
        $this->Acl->allow($role, 'controllers/Cattramites/tramites');
        $this->Acl->allow($role, 'controllers/Cattramites/tramite');
        $this->Acl->allow($role, 'controllers/Usuarios/md_correo');
        $this->Acl->allow($role, 'controllers/Usuarios/umd_contrasena');
        $this->Acl->allow($role, 'controllers/Tramites/nuevo');
        $this->Acl->allow($role, 'controllers/Usuarios/nuevo_correo');
        $this->Acl->allow($role, 'controllers/Tareas/asignar');
//----------------------------ADMIN-------------------------
        $role->id = 1;
        $this->Acl->allow($role, 'controllers/Pages/display');
        $this->Acl->allow($role, 'controllers/Pages/display/inicio');
        $this->Acl->allow($role, 'controllers/Pages/display/catalogos');
        $this->Acl->allow($role, 'controllers/Facultades');
        $this->Acl->allow($role, 'controllers/Carreras');
        $this->Acl->allow($role, 'controllers/Usuarios/logout');
        $this->Acl->allow($role, 'controllers/Usuarios/index');
        $this->Acl->allow($role, 'controllers/Usuarios/nuevo');
        $this->Acl->allow($role, 'controllers/Usuarios/md_contrasena');
        $this->Acl->allow($role, 'controllers/Usuarios/amd_contrasena');
        $this->Acl->allow($role, 'controllers/Usuarios/md_estado');
        $this->Acl->allow($role, 'controllers/Cattramites');
        $this->Acl->allow($role, 'controllers/Catcargos');
        $this->Acl->allow($role, 'controllers/Asignaturas');
        $this->Acl->allow($role, 'controllers/Empleados');
        $this->Acl->allow($role, 'controllers/Cuentas');
        $this->Acl->allow($role, 'controllers/Pages/display/config');
        $this->Acl->allow($role, 'controllers/Usuarios/md_correo');
        $this->Acl->allow($role, 'controllers/Usuarios/umd_contrasena');
        $this->Acl->allow($role, 'controllers/Usuarios/nuevo_correo');
        $this->Acl->deny($role, 'controllers/Tareas/asignar');
//-------------------------OPERADORES--------------------
        $role->id = 2;
        $this->Acl->allow($role, 'controllers/Pages/display');
        $this->Acl->allow($role, 'controllers/Pages/display/inicio');
        $this->Acl->allow($role, 'controllers/Usuarios/logout');
        $this->Acl->deny($role, 'controllers/Pages/display/catalogos');
        $this->Acl->allow($role, 'controllers/Pages/display/config');
        $this->Acl->allow($role, 'controllers/Usuarios/md_correo');
        $this->Acl->allow($role, 'controllers/Usuarios/umd_contrasena');
        $this->Acl->allow($role, 'controllers/Usuarios/nuevo_correo');
        $this->Acl->allow($role, 'controllers/Tareas/index');

        echo 'ok?';
    }

}
