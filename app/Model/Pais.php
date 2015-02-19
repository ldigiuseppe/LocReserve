<?php

App::uses('AppModel', 'Model');

/**
 * Paise Model
 *
 */
class Pais extends AppModel {

    public $useTable = 'paises';
    public $primaryKey = 'id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'nombre';

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Cliente' => array(
            'className' => 'Cliente',
            'foreignKey' => 'pais_id',
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
