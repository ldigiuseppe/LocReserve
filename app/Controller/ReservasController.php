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

    public $helpers = array('Js');

    public function index() {

        $this->paginate = array(
            'contain' => array(
                'LocacionReserva' => array(
                    'Locacion' => array (
                        'TipoLocacion'
                    )
                ), 
                'Cliente',
                'Usuario'),
            'limit' => 12,
            'order' => array('Reserva.fecha_desde' => 'asc')
        );
        $reservas = $this->paginate($this->Reserva);
        $this->set(compact('reservas'));
    }

    public function add() {

        //Verifico si es un post
        if ($this->request->is('put') || $this->request->is('Post')) {

            //guardo datos del formulario
            $data = $this->request->data;

            // Verifico que existan datos
            if (!empty($data)) {

                $this->loadModel('Cliente');
                $this->loadModel('LocacionReserva');

                $this->Reserva->create();

                $this->Cliente->create();
                $this->Cliente->set($data);

                // Comienzo transaccion
                $dataSource = $this->Reserva->getDataSource();
                $dataSource->begin();

                if ($this->Reserva->validates(array('fieldList' => array('fecha_desde', 'fecha_hasta')))) {
                    if ($this->Cliente->validates()) {
                        $this->Cliente->save();

                        $data['Reserva']['cliente_id'] = $this->Cliente->id;
                        $data['Reserva']['usuario_id'] = $this->Auth->user('id');

                        $data ['Reserva']['fecha_desde'] = $this->cambiarfecha_mysql($data ['Reserva']['fecha_desde']);
                        $data ['Reserva']['fecha_hasta'] = $this->cambiarfecha_mysql($data ['Reserva']['fecha_hasta']);
                        $this->Reserva->set($data);
                        $this->Reserva->save();

                        if (!empty($data['Reserva']['LocacionReserva'])) {
                            foreach ($data['Reserva']['LocacionReserva'] as $locacion_reserva) {
                                $locacion_reserva['reserva_id'] = $this->Reserva->id;
                                $this->LocacionReserva->create();
                                $this->LocacionReserva->save($locacion_reserva);
                            }


                            // todo: validar que cargue al menos un locacionReserva y que no se repita y que este disponible
                            $dataSource->commit();
                            $this->Session->setFlash(__('La reserva ha sido guardada'), 'flash_success');
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->LocacionReserva->validationErrors['validaLocaciones'] = "Agregue al menos una locación";
                        }
                    }
                }
                $dataSource->rollback();
            }
        }

        // Obtener tipos de cabañas
        $this->set('tipo_cabanias', $this->Reserva->LocacionReserva->Locacion->TipoLocacion->find(
                        'list', array(
                    'fields' => array('TipoLocacion.id', 'TipoLocacion.titulo'),
                    'order' => array('TipoLocacion.id')
        )));

        $this->loadModel('Pais');

        $this->set('paises', $this->Pais->find(
                        'list', array(
                    'fields' => array('Pais.id', 'Pais.nombre'),
                    'order' => array('Pais.id')
        )));
    }

    function cambiarfecha_mysql($fecha) {
        list($dia, $mes, $ano) = explode("/", $fecha);
        $fecha = "$ano-$mes-$dia";
        return $fecha;
    }

}
