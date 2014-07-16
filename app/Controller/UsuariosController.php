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
        'fields' => array('id', 'alias'),
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
                        $llave = substr(md5('SISTA' . $this->request->data['Usuario']['alias']), 0, 10);
                        $this->__enviar($this->request->data['Usuario']['correo'], $this->request->data['Usuario']['alias'], $llave);
                        $this->Session->setFlash(__('Se ha enviado una verificación a tu correo, para continuar revisar el mismo.'), array('class' => 'OK'));
                        return $this->redirect('/');
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
                    $this->Session->setFlash(__('Debido a comportamiento inadecuado tu usuario ha sido suspendido.'), array('class' => 'ALERT'));
                } else {
                    $this->Auth->logout();
                    $this->Session->setFlash(__('Tu usuario no está activo, verifica tu cuenta de correo.'), array('class' => 'ALERT'));
                }
            } else {
                $this->Session->setFlash(__('Las credenciales ingresadas no son validas'), array('class' => 'ALERT'));
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

    public function acl() {
        $this->autoRender = false;
        $role = $this->Usuario->Role;
        $role->id = 1;
        $this->Acl->allow($role, 'controllers/Pages/display');
        $this->Acl->allow($role, 'controllers/Pages/display/inicio');
        $this->Acl->allow($role, 'controllers/Pages/display/catalogos');
        $this->Acl->allow($role, 'controllers/Facultades');
        $this->Acl->allow($role, 'controllers/Carreras');
        $this->Acl->allow($role, 'controllers/Usuarios/logout');
        $this->Acl->allow($role, 'controllers/Usuarios/index');
        echo 'ok?';
    }

    public function admin() {
        $this->autoRender = false;
        $data = array(
            'Usuario' => array(
                'alias' => 'admin',
                'contrasena' => 'sista',
                'correo' => 'firecat666@hotmail.com',
                'estado' => 1,
                'role_id' => 1
            )
        );
        $validador = $this->Usuario->validator();
        $this->Usuario->create();
        var_dump($validador['alias']['formato'] = array(
            'rule' => 'alphaNumeric',
        ));
        if ($this->Usuario->save($data)) {
            echo 1;
        } else
            echo 0;
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
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The usuario has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Usuario->Role->find('list');
        $this->set(compact('roles'));
    }

    public function edit($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The usuario has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $roles = $this->Usuario->Role->find('list');
        $this->set(compact('roles'));
    }

    public function delete($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('The usuario has been deleted.'));
        } else {
            $this->Session->setFlash(__('The usuario could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
