<?php

App::uses('AppModel', 'Model');

/**
 * Cattramite Model
 *
 * @property Calendario $Calendario
 * @property Cattarea $Cattarea
 * @property Tramite $Tramite
 */
class Cattramite extends AppModel {

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
        'arancel' => array(
            'formato' => array(
                'rule' => '/^[0-9]+(\.[0-9]{1,2})?$/',
                'message' => 'Solo valores positivos con 2 decimales.',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'porcentajerecargo' => array(
            'decimal' => array(
                'rule' => '/^[0-9]+(\.[0-9]{1,2})?$/',
                'message' => 'Solo valores positivos con 2 decimales.',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Calendario' => array(
            'className' => 'Calendario',
            'foreignKey' => 'cattramite_id',
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
        'Cattarea' => array(
            'className' => 'Cattarea',
            'foreignKey' => 'cattramite_id',
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
        'Tramite' => array(
            'className' => 'Tramite',
            'foreignKey' => 'cattramite_id',
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

}
