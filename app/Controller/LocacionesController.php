<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP LocacionController
 * @author lucho
 */
class LocacionesController extends AppController {

    public function index() {
        
    }

    public function obtenerSegunTipoLocacion() {
        //var_dump($this->request);
        $tipo_locacion_id = $this->request->data['Reserva']['tipo_cabania'];

        $this->loadModel('Locacion');

        $locaciones = $this->Locacion->find('list', array(
            'conditions' => array('Locacion.tipo_locacion_id' => $tipo_locacion_id),
            'recursive' => -1
        ));

        $this->set('locaciones', $locaciones);
        $this->layout = 'ajax';
    }

}
