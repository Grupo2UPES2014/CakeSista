<?php

App::uses('AppModel', 'Model');

/**
 * Empleado Model
 *
 * @property Usuario $Usuario
 * @property Catcargo $Catcargo
 * @property Tarea $Tarea
 */
class Empleado extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'nombres';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'nombres' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'apellido1' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'usuario_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'catcargo_id' => array(
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
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Catcargo' => array(
            'className' => 'Catcargo',
            'foreignKey' => 'catcargo_id',
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
        'Tarea' => array(
            'className' => 'Tarea',
            'foreignKey' => 'empleado_id',
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

    public function obtenerCargoEmpleado($id = NULL) {
        $options = array('conditions' => array('usuario_id' => $id));
        $empleado = $this->find('first', $options);
        if (!empty($empleado)) {
            return $empleado['Empleado']['catcargo_id'];
        } else {
            return false;
        }
    }

    public function obtenerEmpleado_id($usuario = NULL) {
        $options = array('conditions' => array('usuario_id' => $usuario));
        $empleado = $this->find('first', $options);
        if (!empty($empleado)) {
            return $empleado['Empleado']['id'];
        } else {
            return false;
        }
    }

}
