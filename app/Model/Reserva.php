<?php

App::uses('AppModel', 'Model');

/**
 * Reserva Model
 *
 * @property Usuario $Usuario
 * @property Cliente $Cliente
 */
class Reserva extends AppModel {

    public $useTable = 'reservas';
    public $primaryKey = 'id';

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
        'fecha_creacion' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            ),
        ),
        'fecha_actualizacion' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            ),
        ),
        'fecha_desde' => array(
            'date' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Completa este campo antes de continuar',
                'allowEmpty' => false,
            ),
        ),
        'fecha_hasta' => array(
            'date' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Completa este campo antes de continuar',
                'allowEmpty' => false,
            ),
        ),
        'hora_arribo' => array(
            'time' => array(
                'rule' => array('time'),
                'allowEmpty' => true,
            ),
        ),
        'total' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Completa este campo antes de continuar',
                'allowEmpty' => false,
            ),
        ),
        'senia' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Completa este campo antes de continuar',
                'allowEmpty' => false,
            ),
        ),
        'usuario_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'required' => true,
            ),
        ),
        'cliente_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'required' => true,
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
        'Cliente' => array(
            'className' => 'Cliente',
            'foreignKey' => 'cliente_id',
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
        'LocacionReserva' => array(
            'className' => 'LocacionReserva',
            'foreignKey' => 'reserva_id',
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
