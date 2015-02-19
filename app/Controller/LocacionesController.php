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

    public function popularTiposLocacion() {

        $fecha_desde = $this->request->data['Reserva']['fecha_desde'];
        $fecha_hasta = $this->request->data['Reserva']['fecha_hasta'];

        $this->loadModel('Locacion');

        $resultado = $this->Locacion->query("SELECT tipos_locacion.*
                                            FROM `locaciones`
                                            LEFT OUTER JOIN locacion_reserva 
                                            ON locacion_reserva.locacion_id = locaciones.id
                                            LEFT JOIN tipos_locacion
                                            ON tipos_locacion.id = locaciones.tipo_locacion_id
                                            WHERE locaciones.id
                                                    NOT IN (
                                                    SELECT locacion_reserva.locacion_id
                                                    FROM reservas
                                                    LEFT JOIN locacion_reserva 
                                                            ON reservas.id = locacion_reserva.reserva_id
                                                    WHERE NOT (reservas.fecha_hasta < '" . $this->cambiarfecha_mysql($fecha_desde) . "'
                                                              OR reservas.fecha_desde > '" . $this->cambiarfecha_mysql($fecha_hasta) . "')
                                                )
                                            GROUP BY locaciones.tipo_locacion_id");

        echo json_encode($resultado);
        $this->autoRender = false;
        $this->layout = 'ajax';
    }

    public function popularTiposLocacionEdicion() {

        $id_reserva = $this->request->data['Reserva']['id'];
        $fecha_desde = $this->request->data['Reserva']['fecha_desde'];
        $fecha_hasta = $this->request->data['Reserva']['fecha_hasta'];

        $this->loadModel('Locacion');

        $resultado = $this->Locacion->query("SELECT tipos_locacion.*
                                            FROM `locaciones`
                                            LEFT OUTER JOIN locacion_reserva 
                                            ON locacion_reserva.locacion_id = locaciones.id
                                            LEFT JOIN tipos_locacion
                                            ON tipos_locacion.id = locaciones.tipo_locacion_id
                                            WHERE locaciones.id
                                                    NOT IN (
                                                    SELECT locacion_reserva.locacion_id
                                                    FROM reservas
                                                    LEFT JOIN locacion_reserva 
                                                            ON reservas.id = locacion_reserva.reserva_id
                                                    WHERE NOT (reservas.fecha_hasta < '" . $this->cambiarfecha_mysql($fecha_desde) . "'
                                                              OR reservas.fecha_desde > '" . $this->cambiarfecha_mysql($fecha_hasta) . "')
                                                              AND reservas.id != '" . $id_reserva . "'
                                                )
                                            GROUP BY locaciones.tipo_locacion_id");

        echo json_encode($resultado);
        $this->autoRender = false;
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

    public function popularLocaciones() {

        $tipo_locacion_id = $this->request->data['Reserva']['tipo_cabania'];
        $fecha_desde = $this->request->data['Reserva']['fecha_desde'];
        $fecha_hasta = $this->request->data['Reserva']['fecha_hasta'];

        $this->loadModel('Locacion');

        $resultado = $this->Locacion->query("SELECT locaciones.*, tipos_locacion.cantidad_adultos 
                                            FROM `locaciones`
                                            LEFT OUTER JOIN locacion_reserva 
                                            ON locacion_reserva.locacion_id = locaciones.id
                                            LEFT JOIN tipos_locacion
                                            ON tipos_locacion.id = locaciones.tipo_locacion_id
                                            WHERE locaciones.id
                                                    NOT IN (
                                                    SELECT locacion_reserva.locacion_id
                                                    FROM reservas
                                                    LEFT JOIN locacion_reserva 
                                                            ON reservas.id = locacion_reserva.reserva_id
                                                    WHERE NOT (reservas.fecha_hasta < '" . $this->cambiarfecha_mysql($fecha_desde) . "'
                                                              OR reservas.fecha_desde > '" . $this->cambiarfecha_mysql($fecha_hasta) . "')
                                                )
                                            AND locaciones.tipo_locacion_id = '" . $tipo_locacion_id . "'
                                            GROUP BY locaciones.id");

        /* $locaciones = $this->Locacion->find('list', array(
          'conditions' => array('Locacion.tipo_locacion_id' => $tipo_locacion_id),
          'recursive' => -1
          )); */

        echo json_encode($resultado);
        $this->autoRender = false;
        $this->layout = 'ajax';
    }

    function popularLocacionesEdicion() {

        $id_reserva = $this->request->data['Reserva']['id'];
        $tipo_locacion_id = $this->request->data['Reserva']['tipo_cabania'];
        $fecha_desde = $this->request->data['Reserva']['fecha_desde'];
        $fecha_hasta = $this->request->data['Reserva']['fecha_hasta'];

        $this->loadModel('Locacion');

        $resultado = $this->Locacion->query("SELECT locaciones.*, tipos_locacion.cantidad_adultos 
                                            FROM `locaciones`
                                            LEFT OUTER JOIN locacion_reserva 
                                            ON locacion_reserva.locacion_id = locaciones.id
                                            LEFT JOIN tipos_locacion
                                            ON tipos_locacion.id = locaciones.tipo_locacion_id
                                            WHERE locaciones.id
                                                    NOT IN (
                                                    SELECT locacion_reserva.locacion_id
                                                    FROM reservas
                                                    LEFT JOIN locacion_reserva 
                                                            ON reservas.id = locacion_reserva.reserva_id
                                                    WHERE NOT (reservas.fecha_hasta < '" . $this->cambiarfecha_mysql($fecha_desde) . "'
                                                              OR reservas.fecha_desde > '" . $this->cambiarfecha_mysql($fecha_hasta) . "')
                                                              AND reservas.id != '" . $id_reserva . "'                                                                  
                                                )
                                            AND locaciones.tipo_locacion_id = '" . $tipo_locacion_id . "'
                                            GROUP BY locaciones.id");

        /* $locaciones = $this->Locacion->find('list', array(
          'conditions' => array('Locacion.tipo_locacion_id' => $tipo_locacion_id),
          'recursive' => -1
          )); */

        echo json_encode($resultado);
        $this->autoRender = false;
        $this->layout = 'ajax';
    }

}
