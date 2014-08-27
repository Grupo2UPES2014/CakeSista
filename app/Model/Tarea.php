<?php

App::uses('AppModel', 'Model');

/**
 * Tarea Model
 *
 * @property Cattarea $Cattarea
 * @property Empleado $Empleado
 * @property Tramite $Tramite
 * @property Formulario $Formulario
 */
class Tarea extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
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
        'observaciones' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'created' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'modified' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'tipo' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cattarea_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'empleado_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'tramite_id' => array(
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
        'Cattarea' => array(
            'className' => 'Cattarea',
            'foreignKey' => 'cattarea_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Empleado' => array(
            'className' => 'Empleado',
            'foreignKey' => 'empleado_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Tramite' => array(
            'className' => 'Tramite',
            'foreignKey' => 'tramite_id',
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
        'Formulario' => array(
            'className' => 'Formulario',
            'foreignKey' => 'tarea_id',
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

    public function existenTareas($id) {
        $options = array('conditions' => array('tramite_id' => $id), 'fields' => array('id'));
        $tareas = $this->find('list', $options);
        if (!empty($tareas)) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerPrimeraTarea($id) {
        if ($cattramite = $this->Tramite->obtenerIdCattramite($id)) {
            $options = array('conditions' => array('cattarea.cattramite_id' => $cattramite), 'fields' => array('id'), 'recursive' => 0);
            $cattarea = $this->Cattarea->find('first', $options);
            return $cattarea['Cattarea']['id'];
        }
        else{
            return false;
        }
    }

    public function obtenerTipo($id) {
        $options = array('conditions' => array('id' => $id), 'fields' => array('cattarea_id'));
        $tarea = $this->find('first', $options);
        if (empty($tarea)) {

            //$options = array('conditions' => array('cattarea.id' => $id));
            $cattarea = $this->Cattarea->find('first', $options);
            var_dump($tarea);
            if (empty($cattarea)) {
                return $cattarea['Cattarea']['tipo'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
