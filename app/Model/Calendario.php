<?php

App::uses('AppModel', 'Model');

/**
 * Calendario Model
 *
 * @property Cattramite $Cattramite
 */
class Calendario extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'nombre';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'nombre' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'fechainicio' => array(
            'date' => array(
                'rule' => array('date'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'fechafinal' => array(
            'date' => array(
                'rule' => array('date'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'arancel' => array(
            'decimal' => array(
                'rule' => array('decimal'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cattramite_id' => array(
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
        'Cattramite' => array(
            'className' => 'Cattramite',
            'foreignKey' => 'cattramite_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function existe($cattramite_id) {
        $options = array('conditions' => array('cattramite_id' => $cattramite_id), 'recursive' => -1);
        $calendarios = $this->find('first', $options);
        if (empty($calendarios)) {
            return false;
        } else {
            return true;
        }
    }

    public function obtenerPorPeriodo($cattramite_id) {
        $fecha = date('Y-m-d');
        $options = array('conditions' => array('cattramite_id' => $cattramite_id, 'fechainicio <=' => $fecha, 'fechafinal >=' => $fecha));
        $calendario = $this->find('first', $options);
        if (!empty($calendario)) {
            return $calendario;
        } else {
            return false;
        }
    }

}
