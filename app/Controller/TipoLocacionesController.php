<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP TipoLocacionesController
 * @author lucho
 */
class TipoLocacionesController extends AppController {

    public function index($id) {
        
    }

    public function obtenerCantidadAdultos() {
        //var_dump($this->request);
        $tipo_locacion_id = $this->request->data['Reserva']['tipo_cabania'];

        $this->loadModel('TipoLocacion');
        
        $tipo_locacion = $this->TipoLocacion->findById($tipo_locacion_id);
        
        $cantidadMax = $tipo_locacion['TipoLocacion']['cantidad_adultos'];

        /*$tipo_locacion = $this->TipoLocacion->find('list', array(
            'conditions' => array('Locacion.tipo_locacion_id' => $tipo_locacion_id),
            'recursive' => -1
        ));*/

        $this->set('cantidadMax', $cantidadMax);
        $this->layout = 'ajax';
    }

}
