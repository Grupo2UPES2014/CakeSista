<?php

App::uses('AppModel', 'Model');

/**
 * Tramite Model
 *
 * @property Estudiante $Estudiante
 * @property Cattramite $Cattramite
 * @property Mandamiento $Mandamiento
 * @property Tarea $Tarea
 */
class Tramite extends AppModel {

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
            'boolean' => array(
                'rule' => array('boolean'),
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
        'fechafin' => array(
            'date' => array(
                'rule' => array('date'),
                //'message' => 'Your custom message here',
                'allowEmpty' => true,
            //'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'estudiante_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
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
        'Estudiante' => array(
            'className' => 'Estudiante',
            'foreignKey' => 'estudiante_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Cattramite' => array(
            'className' => 'Cattramite',
            'foreignKey' => 'cattramite_id',
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
        'Mandamiento' => array(
            'className' => 'Mandamiento',
            'foreignKey' => 'tramite_id',
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
        'Tarea' => array(
            'className' => 'Tarea',
            'foreignKey' => 'tramite_id',
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

    public function obtenerIdCattramite($id) {
        $options = array('conditions' => array('tramite.id' => $id), 'fields' => array('cattramite_id'), 'recursive' => 0);
        $tramite = $this->find('first', $options);
        if (!empty($tramite)) {
            return $tramite['Tramite']['cattramite_id'];
        } else {
            return false;
        }
    }

    public function finalizar($id = NULL) {
        $this->read(null, $id);
        $this->set('estado', 0);
        $this->set('fechafin', date('Y-m-d'));
        if ($this->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtenerArancel($id = null) {
        $options = array('conditions' => array('Tramite.id' => $id), 'fields' => array('Cattramite.arancel'));
        $tramite = $this->find('first', $options);
        return $tramite['Cattramite']['arancel'];
    }

    public function obtenerEstudianteNui($id = null) {
        $options = array('conditions' => array('Tramite.id' => $id), 'fields' => array('Estudiante.nui'));
        $tramite = $this->find('first', $options);
        return $tramite['Estudiante']['nui'];
    }

    public function obtenerCodigo($id = null) {
        $options = array('conditions' => array('Tramite.id' => $id), 'fields' => array('Cattramite.codigo'));
        $tramite = $this->find('first', $options);
        return $tramite['Cattramite']['codigo'];
    }

    public function owner($id = null, $estudiante = null) {
        $options = array('conditions' => array('Tramite.id' => $id, 'Tramite.estudiante_id' => $estudiante), 'recursive' => 0);
        $tramite = $this->find('first', $options);
        if (!empty($tramite)) {
            return true;
        } else {
            return false;
        }
    }

    public function activos($id = null, $cattramite_id = null) {
        $estudiante_id = $this->Estudiante->obtener_id($id);
        $options = array('conditions' => array('estudiante_id' => $estudiante_id, 'estado' => 1, 'cattramite_id' => $cattramite_id));
        $tramites = $this->find('first', $options);
        if (!empty($tramites)) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCorreoyTramite($id) {
        $options = array(
            'conditions' => array('Tramite.id' => $id),
            'fields' => array('Cattramite.nombre', 'Usuario.correo'),
            'recursive' => 0
        );
        $options['joins'] = array(
            array('table' => 'usuarios',
                'alias' => 'Usuario',
                'type' => 'INNER',
                'conditions' => array('Usuario.id = Estudiante.usuario_id')
            )
        );

        $tramite = $this->find('first', $options);
        if (!empty($tramite)) {
            return $tramite;
        } else {
            return false;
        }
    }

}
