<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Usuario extends AppModel {

    public $actsAs = array('Acl' => array('type' => 'requester'));
    public $displayField = 'alias';
    public $validate = array(
        'alias' => array(
            'formato' => array(
                'rule' => '/^[a-zA-Z]{2}[0-9]{6}$/',
                'message' => 'Formato invalido',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'Unico' => array(
                'rule' => array('isUnique'),
                'message' => 'Este carnet ya está en uso',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'contrasena' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'correo' => array(
            'email' => array(
                'rule' => array('email'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'Unico' => array(
                'rule' => array('isUnique'),
                'message' => 'Este correo ya está en uso.',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'estado' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'role_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Empleado' => array(
            'className' => 'Empleado',
            'foreignKey' => 'usuario_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Estudiante' => array(
            'className' => 'Estudiante',
            'foreignKey' => 'usuario_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function existeAlumno($carnet) {
        $options = array('conditions' => array('Estudiante.carnet' => $carnet));
        if ($this->Estudiante->find('first', $options)) {
            return true;
        }
        return false;
    }

    public function actualizarEstudiante($carnet, $id) {
        $options = array('conditions' => array('Estudiante.carnet' => $carnet), 'fields' => array('id'));
        $estudiante = $this->Estudiante->find('first', $options);
        $this->Estudiante->read(null, $estudiante['Estudiante']['id']);
        $this->Estudiante->set('usuario_id', $id);
        if ($this->Estudiante->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'md5'));
        $this->data['Usuario']['contrasena'] = $passwordHasher->hash($this->data['Usuario']['contrasena']);
    }

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['Usuario']['role_id'])) {
            $groupId = $this->data['Usuario']['role_id'];
        } else {
            $groupId = $this->field('role_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Role' => array('id' => $groupId));
        }
    }

    public function bindNode($user) {
        return array('model' => 'Role', 'foreign_key' => $user['Usuario']['role_id']);
    }

}
