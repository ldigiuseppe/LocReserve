<?php

App::uses('AppModel', 'Model');

/**
 * LocacionesHasReserva Model
 *
 * @property Locacion $Locacion
 * @property Reserva $Reserva
 */
class LocacionReserva extends AppModel {
    public $actsAs = array('Containable');

    public $useTable = 'locacion_reserva';

    /**
     * Primary key field
     *
     * @var string
     */
//    public $primaryKey = 'locacion_id';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'locacion_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'reserva_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cantidad_adultos' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cantidad_ninos' => array(
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
        'Locacion' => array(
            'className' => 'Locacion',
            'foreignKey' => 'locacion_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Reserva' => array(
            'className' => 'Reserva',
            'foreignKey' => 'reserva_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
