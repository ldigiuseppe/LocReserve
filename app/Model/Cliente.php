<?php

App::uses('AppModel', 'Model');

/**
 * Cliente Model
 *
 * @property Pais $Pais
 * @property Reserva $Reserva
 */
class Cliente extends AppModel {

    public $useTable = 'clientes';
    public $primaryKey = 'id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'apellido';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'nombre' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Completa este campo antes de continuar',
                'allowEmpty' => false,
            ),
        ),
        'apellido' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Completa este campo antes de continuar',
                'allowEmpty' => false,
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Ingrese un email válido',
                'allowEmpty' => true,
            ),
        ),
        'pais_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Seleccione una opción',
                'allowEmpty' => true,
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
        'Pais' => array(
            'className' => 'Pais',
            'foreignKey' => 'pais_id',
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
        'Reserva' => array(
            'className' => 'Reserva',
            'foreignKey' => 'cliente_id',
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
