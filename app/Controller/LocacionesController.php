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

        $tipo_locacion_id = $this->request->data['Reserva']['tipo_cabania'];

        $this->loadModel('Locacion');

        $locaciones = $this->Locacion->find('list', array(
            'conditions' => array('Locacion.tipo_locacion_id' => $tipo_locacion_id),
            'recursive' => -1
        ));

        $this->set('locaciones', $locaciones);
        $this->layout = 'ajax';
    }

    public function obtenerCantidadAdultosLocacion() {

        $tipo_locacion_id = $this->request->data['Reserva']['tipo_cabania'];

        $this->loadModel('TipoLocacion');

        $locaciones = $this->TipoLocacion->find('first', array(
            'conditions' => array('TipoLocacion.id' => $tipo_locacion_id),
            'recursive' => -1
        ));

        $cantidad_adultos = $locaciones ['TipoLocacion'] ['cantidad_adultos'];

        $arreglo_cantidades = array();

        for ($i = 0; $i <= $cantidad_adultos; $i++) {
            $arreglo_cantidades [$i] = $i;
        }

        $this->set('arreglo_cantidades', $arreglo_cantidades);
        $this->layout = 'ajax';
    }

}
