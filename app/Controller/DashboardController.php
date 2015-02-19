<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP DashboardController
 * @author lucho
 */
class DashboardController extends AppController {

    public function index() {

        $this->loadModel('Reserva');

        $reservasIngresan = $this->Reserva->find('all', array(
            'conditions' => array(
                'Reserva.fecha_desde' => date('Y-m-d')
            ),
            'contain' => array(
                'LocacionReserva' => array(
                    'Locacion' => array(
                        'TipoLocacion'
                    )
                ),
                'Cliente',
                'Usuario')
        ));

        $this->set('reservas_ingresan', $reservasIngresan);

        $reservasSalen = $this->Reserva->find('all', array(
            'conditions' => array(
                'Reserva.fecha_hasta' => date('Y-m-d', strtotime("-1 days"))
            ),
            'contain' => array(
                'LocacionReserva' => array(
                    'Locacion' => array(
                        'TipoLocacion'
                    )
                ),
                'Cliente',
                'Usuario')
        ));

        $this->set('reservas_salen', $reservasSalen);
    }

}
