<?php

App::uses('AppModel', 'Model');

/**
 * Mandamiento Model
 *
 * @property Tramite $Tramite
 * @property Cuenta $Cuenta
 */
class Mandamiento extends AppModel {

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
        'fechaemision' => array(
            'date' => array(
                'rule' => array('date'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'npe' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'codigobarras' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'descripcion' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
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
        'cuenta_id' => array(
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
        'Tramite' => array(
            'className' => 'Tramite',
            'foreignKey' => 'tramite_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Cuenta' => array(
            'className' => 'Cuenta',
            'foreignKey' => 'cuenta_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function existe($tramite_id) {
        $options = array('conditions' => array('tramite_id' => $tramite_id), 'fields' => array('id'));
        if ($this->find('first', $options)) {
            return true;
        } else {
            return false;
        }
    }

    public function generarCodigos($arancel, $emision, $nui, $codigo, $anio) {
        $caracteres = '000000';
        $numero = ((int) $arancel) . '00';
        $caracteres = substr($caracteres, 0, strlen($caracteres) - strlen($numero)) . $numero;
        $fechaObj = new DateTime($emision);
        $fechaObj->add(new DateInterval('P1D'));
        $fecha = $fechaObj->format('Y-m-d');
        $fecha = str_replace('-', '', $fecha);
        $npeMedio = $caracteres . $fecha . '00';
        $npeFinal = $nui . $codigo . '1' . $this->getCiclo() . substr($anio, 2, 2);
        $caracteres = '0000000000';
        $numero = ((int) $arancel) . '00';
        $caracteres = substr($caracteres, 0, strlen($caracteres) - strlen($numero)) . $numero;
        //$caracteres=substr($caracteres,0,count($caracteres)-count($numero)).$numero;
        $cuenta = $this->getCuenta();
        $barrasFinal = $caracteres . '(96)' . $fecha . '(8020)0' . $npeFinal;
        $npeTemp = $cuenta . $npeMedio . $npeFinal;
        $barras = "(415)74197000" . $cuenta . "1(3902)" . $barrasFinal;
        $npeTemp = $npeTemp . $this->generarVerificador($npeTemp);
        //$this->npe = $npeTemp;
        //$this->codigobarras = $barras;
        return array('npe' => $npeTemp, 'codigobarras' => $barras);
    }

    public function generarVerificador($npe) {
        $iImpares = 0;
        $iPares = 0;
        for ($i = 0; $i < strlen($npe); $i++) {
            if ($i % 2 == 0) {
                $impares[$iImpares] = (int) $npe[$i];
                $iImpares++;
            } else {
                $pares[$iPares] = (int) $npe[$i];
                $iPares++;
            }
        }
        $tImpares = 0;
        for ($i = 0; $i < count($impares); $i++) {
            $tImpares+=($impares[$i] * 2);
            if (($impares[$i] * 2) >= 10) {
                $tImpares+=1;
            }
        }
        $tPares = 0;
        for ($i = 0; $i < count($pares); $i++) {
            $tPares+=$pares[$i];
        }
        $A = (int) ($tImpares + $tPares);
        $B = (int) ($A / 10);
        $C = (int) ($B * 10);
        $D = (int) ($A - $C);
        $E = (int) (10 - $D);
        $F = (int) ($E / 10);
        $G = (int) ($F * 10);
        $VR = (int) ($E - $G);
        return $VR;
    }

    public function getNpeFormato($_npe) {
        $npe = '';

        for ($i = 0; $i < strlen($_npe); $i++) {

            if ($i % 4 == 0) {
                $npe.=' ' . $_npe[$i];
            } else {
                $npe.=$_npe[$i];
            }
        }
        return $npe;
    }

    public function getCuenta() {
        $options = array('conditions' => array('Cuenta.activo' => 1));
        $cuenta = $this->Cuenta->find('first', $options);
        if (!empty($cuenta)) {
            return $cuenta['Cuenta']['numero'];
        } else {
            return false;
        }
    }

    public function getCiclo() {
        $mes = date('m');
        $ciclo1 = array(1, 2, 3, 4, 5, 6);
        $ciclo2 = array(7);
        $ciclo3 = array(8, 9, 10, 11, 12);
        if (in_array($mes, $ciclo1)) {
            return 1;
        } else if (in_array($mes, $ciclo2)) {
            return 2;
        } else if (in_array($mes, $ciclo3)) {
            return 3;
        }
    }

}
