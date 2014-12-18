<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP ReservasController
 * @author lucho
 */
class ReservasController extends AppController {

    public function index() {
        
    }

    public $helpers = array('Js');

    public function add() {

        // Obtener tipos de cabañas
        $this->set('tipo_cabanias', $this->Reserva->LocacionReserva->Locacion->TipoLocacion->find(
                        'list', array(
                    'fields' => array('TipoLocacion.titulo'),
                    'order' => array('TipoLocacion.titulo')
        )));
    }

}
