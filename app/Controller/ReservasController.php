<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * CakePHP ReservasController
 * @author lucho
 */
class ReservasController extends AppController {

    public $helpers = array('Js');
    public $components = array('RequestHandler');

    public function index() {

        $filtroReserva = array();

        if ($this->request->is('put') || $this->request->is('Post')) {

            $data = $this->request->data;

            if ($data['Filtro']['cliente'] != "") {
                $filtro = array('OR' => array(
                        'Cliente.apellido LIKE' => '%' . $data['Filtro']['cliente'] . '%',
                        'Cliente.nombre LIKE' => '%' . $data['Filtro']['cliente'] . '%')
                );
                array_push($filtroReserva, $filtro);
            }

            if ($data['Filtro']['usuario_id'] != "") {
                $filtro = array(
                    'Usuario.id' => $data['Filtro']['usuario_id']
                );
                array_push($filtroReserva, $filtro);
            }

            if ($data['Filtro']['locacion_id'] != "") {
                $filtro = array(
                    'Locacion.id' => $data['Filtro']['locacion_id']
                );
                array_push($filtroReserva, $filtro);
            }

            if ($data['Filtro']['creacion_desde'] != "" || $data['Filtro']['creacion_hasta'] != "") {
                if ($data['Filtro']['creacion_desde'] != "" && $data['Filtro']['creacion_hasta'] != "") {
                    $filtro = array('AND' => array(
                            'Reserva.fecha_creacion >=' => $this->cambiarfecha_mysql($data['Filtro']['creacion_desde']),
                            'Reserva.fecha_creacion <=' => $this->cambiarfecha_mysql($data['Filtro']['creacion_hasta']))
                    );
                } else {
                    if ($data['Filtro']['creacion_desde'] != "") {
                        $filtro = array(
                            'Reserva.fecha_creacion >=' => $this->cambiarfecha_mysql($data['Filtro']['creacion_desde'])
                        );
                    } else {
                        $filtro = array(
                            'Reserva.fecha_creacion <=' => $this->cambiarfecha_mysql($data['Filtro']['creacion_hasta'])
                        );
                    }
                }
                array_push($filtroReserva, $filtro);
            }

            if ($data['Filtro']['reserva_desde'] != "" || $data['Filtro']['reserva_hasta'] != "") {
                if ($data['Filtro']['reserva_desde'] != "" && $data['Filtro']['reserva_hasta'] != "") {
                    $filtro = array('AND' => array(
                            'Reserva.fecha_desde >=' => $this->cambiarfecha_mysql($data['Filtro']['reserva_desde']),
                            'Reserva.fecha_hasta <=' => $this->cambiarfecha_mysql($data['Filtro']['reserva_hasta']))
                    );
                } else {
                    if ($data['Filtro']['reserva_desde'] != "") {
                        $filtro = array(
                            'Reserva.fecha_desde >=' => $this->cambiarfecha_mysql($data['Filtro']['reserva_desde'])
                        );
                    } else {
                        $filtro = array(
                            'Reserva.fecha_hasta <=' => $this->cambiarfecha_mysql($data['Filtro']['reserva_hasta'])
                        );
                    }
                }
                array_push($filtroReserva, $filtro);
            }

            if ($data['Filtro']['pago_id'] != "") {
                $filtro = array(
                    'Reserva.tipo_pago' => $data['Filtro']['pago_id']
                );
                array_push($filtroReserva, $filtro);
            }
        }

        $this->paginate = array(
            'fields' => array('*'),
            'contain' => array(
                'Cliente',
                'Usuario'),
            'joins' => array(
                array(
                    'alias' => 'LocacionReserva',
                    'table' => 'locacion_reserva',
                    'type' => 'LEFT',
                    'conditions' => '`LocacionReserva`.`reserva_id` = `Reserva`.`id`'
                ),
                array(
                    'alias' => 'Locacion',
                    'table' => 'locaciones',
                    'type' => 'LEFT',
                    'conditions' => '`LocacionReserva`.`locacion_id` = `Locacion`.`id`'
                ),
                array(
                    'alias' => 'TipoLocacion',
                    'table' => 'tipos_locacion',
                    'type' => 'LEFT',
                    'conditions' => '`TipoLocacion`.`id` = `Locacion`.`tipo_locacion_id`'
                )
            ),
            'conditions' => $filtroReserva,
            'limit' => 100,
            'order' => array('Reserva.fecha_desde' => 'desc', 'Reserva.id' => 'desc')
        );
        $this->set('reservas', $this->paginate($this->Reserva));


//        $this->paginate = array(
//            'conditions' => $filtro,
//            'contain' => array(
//                'LocacionReserva' => array(
//                    'Locacion' => array(
//                        'conditions' => $filtroLocacion,
//                        'TipoLocacion'
//                    )
//                ),
//                'Cliente',
//                'Usuario'),
//            'condition' => array(
//                'Reserva.Usuario.id' => 2
//            ),
//            'limit' => 10,
//            'order' => array('Reserva.fecha_desde' => 'desc')
//        );
//        
//        $reservas = $this->paginate($this->Reserva);

        $this->set('usuarios', $this->Reserva->Usuario->find('list'));
        $this->loadModel('Locacion');
        $this->set('locaciones', $this->Locacion->find('list'));
        $this->set('lista_pagos', array("Pago parcial", "Pago total", "Impago"));

        $this->set(compact('reservas'));
    }

    public function add() {

        //Verifico si es un post
        if ($this->request->is('put') || $this->request->is('Post')) {

            //guardo datos del formulario
            $data = $this->request->data;

            // Verifico que existan datos
            if (!empty($data)) {
                
                echo '<pre>';
                var_dump($data);
                echo '</pre>';
                exit;

                //Cargo modelos
                $this->loadModel('Cliente');
                $this->loadModel('LocacionReserva');

                $this->Reserva->create();
                $this->Reserva->set('fecha_creacion', date("Y-m-d H:i:s"));

                $this->Cliente->create();
                $this->Cliente->set($data);

                // Comienzo transaccion
                $dataSource = $this->Reserva->getDataSource();
                $dataSource->begin();

                // Verifico que complete fechas de Reserva
                if ($this->Reserva->validates(array('fieldList' => array('fecha_desde', 'fecha_hasta')))) {
                    // Verifico que los datos del cliente sean completos
                    if ($this->Cliente->validates()) {
                        $this->Cliente->save();

                        $data['Reserva']['cliente_id'] = $this->Cliente->id;
                        $data['Reserva']['usuario_id'] = $this->Auth->user('id');

                        $data ['Reserva']['fecha_desde'] = $this->cambiarfecha_mysql($data ['Reserva']['fecha_desde']);
                        $data ['Reserva']['fecha_hasta'] = $this->cambiarfecha_mysql($data ['Reserva']['fecha_hasta']);

                        $this->Reserva->set($data);
                        $this->Reserva->save();

                        // Verifico que seleccione al menos una locacion
                        if (!empty($data['Reserva']['LocacionReserva'])) {
                            $reservaDisponible = true;
                            foreach ($data['Reserva']['LocacionReserva'] as $locacion_reserva) {
                                if (!$this->comprobarDisponibilidad($locacion_reserva['locacion_id'], $data ['Reserva']['fecha_desde'], $data ['Reserva']['fecha_hasta'])) {
                                    $this->LocacionReserva->validationErrors['validaLocaciones'] = "La locacion " . $locacion_reserva['numero_cabania'] . " ha sido ocupada.";
                                    $reservaDisponible = false;
                                    return;
                                }
                                $locacion_reserva['reserva_id'] = $this->Reserva->id;
                                $this->LocacionReserva->create();
                                $this->LocacionReserva->save($locacion_reserva);
                            }
                            if ($reservaDisponible) {
                                
                                $dataSource->commit();
                                
                                //Si tenemos mail de cliente le informamos por email la reserva
                                if ($data['Cliente']['email'] != null && $data['Cliente']['email'] != ''){
                                    $this->enviarEmailReserva($data['Cliente']['nombre']." ".$data['Cliente']['apellido'], $data['Cliente']['email'] , $this->Reserva->id);    
                                }
                                
                                //informamos por mail la reserva al usuario
                                $this->enviarEmailReserva($this->Auth->user('nombre'), $this->Auth->user('email'), $this->Reserva->id);

                                $this->Session->setFlash(__('La reserva ha sido guardada'), 'flash_success');
                                $this->redirect(array('action' => 'index'));
                            }
                        } else {
                            $this->LocacionReserva->validationErrors['validaLocaciones'] = "Agregue al menos una locación";
                        }
                    }
                }
                $dataSource->rollback();
            }
        }
    }

    public function edit($idReserva = null) {

        //Verifico si es un post
        if ($this->request->is('put') || $this->request->is('Post')) {

            //guardo datos del formulario
            $data = $this->request->data;

            // Verifico que existan datos
            if (!empty($data)) {

                $this->loadModel('Cliente');
                $this->loadModel('LocacionReserva');

                // Comienzo transaccion
                $dataSource = $this->Reserva->getDataSource();
                $dataSource->begin();

                if ($this->Reserva->validates(array('fieldList' => array('fecha_desde', 'fecha_hasta')))) {
                    if ($this->Cliente->validates()) {

                        $this->Cliente->save($data['Cliente']);

                        $data['Reserva']['cliente_id'] = $this->Cliente->id;
                        $data['Reserva']['usuario_id'] = $this->Auth->user('id');

                        $data ['Reserva']['fecha_desde'] = $this->cambiarfecha_mysql($data ['Reserva']['fecha_desde']);
                        $data ['Reserva']['fecha_hasta'] = $this->cambiarfecha_mysql($data ['Reserva']['fecha_hasta']);
                        $this->Reserva->set('fecha_actualizacion', date("Y-m-d H:i:s"));

                        $this->Reserva->save($data['Reserva']);

                        if (!empty($data['Reserva']['LocacionReservaNueva'])) {

                            $dataSource->rawQuery("DELETE FROM locacion_reserva WHERE reserva_id= " . $idReserva . "");

                            foreach ($data['Reserva']['LocacionReservaNueva'] as $locacion_reserva) {
                                $locacion_reserva['reserva_id'] = $this->Reserva->id;
                                $this->LocacionReserva->create();
                                $this->LocacionReserva->save($locacion_reserva);
                            }

                            $dataSource->commit();
                            $this->Session->setFlash(__('La reserva ha sido actualizada'), 'flash_success');
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->LocacionReserva->validationErrors['validaLocaciones'] = "Agregue al menos una locación";
                        }
                    }
                }
                $dataSource->rollback();
            }
        }


        if ($idReserva != null) {
            $this->request->data = $this->Reserva->find('first', array(
                'conditions' => array(
                    'Reserva.id' => $idReserva
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
            $fecha_hasta = $this->cambiarfecha_espaniol($this->data['Reserva']['fecha_hasta']);
            $this->set(compact('fecha_hasta'));

            $fecha_desde = $this->cambiarfecha_espaniol($this->data['Reserva']['fecha_desde']);
            $this->set(compact('fecha_desde'));
        }
    }

    public function view($idReserva = null) {
        if ($idReserva != null) {
            $this->request->data = $this->Reserva->find('first', array(
                'conditions' => array(
                    'Reserva.id' => $idReserva
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

            $fecha_hasta = $this->cambiarfecha_espaniol($this->data['Reserva']['fecha_hasta']);
            $this->set(compact('fecha_hasta'));

            $fecha_desde = $this->cambiarfecha_espaniol($this->data['Reserva']['fecha_desde']);
            $this->set(compact('fecha_desde'));
        }
    }

    function delete($idReserva = null) {
        if ($idReserva != null) {
            $reserva = $this->Reserva->findById($idReserva);
            $this->Reserva->delete($idReserva, true);
            $this->Session->setFlash(__('La reserva ha sido eliminada'), 'flash_success');
            $this->redirect(array('action' => 'index'));
        }
    }

    function calendarFeed() {
        $fechaInicial = $this->request->query['start'];
        $fechaFinal = $this->request->query['end'];

        $reservas = $this->Reserva->find('all', array(
            'conditions' => array(
                'Reserva.fecha_desde >=' => $fechaInicial,
                'Reserva.fecha_hasta <=' => $fechaFinal),
            'contain' => array(
                'LocacionReserva' => array(
                    'Locacion' => array(
                        'TipoLocacion'
                    )
                ),
                'Cliente',
                'Usuario')
        ));

        $jsonReservas = array();

        foreach ($reservas as $key => $reserva) {

            $evento = array();

            $evento['title'] = $reserva['Cliente']['apellido'] . ' ' . $reserva['Cliente']['nombre'];
            $evento['allDay'] = 'true';
            $evento['allDay'] = true;
            $evento['start'] = $reserva['Reserva']['fecha_desde'];
            $evento['end'] = date('Y-m-d', strtotime($reserva['Reserva']['fecha_hasta'] . ' + 1 days')); // agrego un dia

            $jsonReservas [] = $evento;
        }


        echo json_encode($jsonReservas);
        $this->layout = 'ajax';
    }

    function calendarFeed2() {

        $fechaInicial = $this->request->query['start'];
        $fechaFinal = $this->request->query['end'];

        $this->loadModel('Locacion');

        $resultado = $this->Locacion->query("
            SELECT fechas.fecha, tipos_locacion.titulo, tipos_locacion.color, COUNT(loc.id) as cantidad_disponible
                FROM fechas
                JOIN locaciones loc
                JOIN tipos_locacion
                ON tipos_locacion.ID = loc.tipo_locacion_id
                WHERE fechas.fecha >=  '" . $fechaInicial . "' AND fechas.fecha <= '" . $fechaFinal . "'
                AND loc.id NOT IN  (
                    SELECT locacion_reserva.locacion_id
                    FROM locacion_reserva
                    JOIN reservas
                    ON reservas.Id = locacion_reserva.reserva_id
                    WHERE reservas.fecha_desde <= fechas.fecha
                    AND reservas.fecha_hasta >= fechas.fecha
                ) 
                GROUP BY fechas.fecha, tipos_locacion.id");

//        $log = $this->Reserva->getDataSource()->getLog(false, false);
//        debug($log);

        /* $this->paginate = array(
          'contain' => array(
          'LocacionReserva' => array(
          'Locacion' => array(
          'TipoLocacion'
          )
          ),
          'Cliente',
          'Usuario'),
          'limit' => 12,
          'order' => array('Reserva.fecha_desde' => 'asc')
          );
          $reservas = $this->paginate($this->Reserva); */
        //$this->set(compact('reservas'));
        //$this->layout = 'ajax';

        $jsonReservas = array();

        foreach ($resultado as $key => $value) {

            $evento = array();

            $evento['title'] = $value['tipos_locacion']['titulo'] . ': ' . $value[0]['cantidad_disponible'];
            $evento['allDay'] = true;
            $evento['start'] = $value['fechas']['fecha'];
            $evento['end'] = $value['fechas']['fecha'];
            $evento['backgroundColor'] = "#" . $value['tipos_locacion']['color'];
            $evento['borderColor'] = "#" . $value['tipos_locacion']['color'];

            $jsonReservas [] = $evento;
        }

        echo json_encode($jsonReservas);
        $this->autoRender = false;

        $this->layout = 'ajax';
    }

    function comprobarDisponibilidad($idLocacion, $fechaDesde, $fechaHasta) {

        $this->loadModel('Locacion');

        $resultado = $this->Locacion->query("SELECT * 
                                            FROM locacion_reserva loc_res
                                            INNER JOIN reservas reserva
                                            ON reserva.id = loc_res.reserva_id
                                            WHERE loc_res.locacion_id = " . $idLocacion . "
                                            AND reserva.fecha_desde >= '" . $fechaDesde . "'
                                            AND reserva.fecha_hasta <= '" . $fechaHasta . "'");

        if (empty($resultado)) {
            return true;
        } else {
            return false;
        }
    }

    function view_pdf($idReserva = null) {

        ini_set('memory_limit', '512M');

        if ($idReserva != null) {
            $this->request->data = $this->Reserva->find('first', array(
                'conditions' => array(
                    'Reserva.id' => $idReserva
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
            $fecha_hasta = $this->cambiarfecha_espaniol($this->data['Reserva']['fecha_hasta']);
            $this->set(compact('fecha_hasta'));

            $fecha_desde = $this->cambiarfecha_espaniol($this->data['Reserva']['fecha_desde']);
            $this->set(compact('fecha_desde'));

           /* $params = array(
                'download' => false,
                'name' => 'example.pdf',
                'paperOrientation' => 'portrait',
                'paperSize' => 'legal'
            );
            $this->set($params);*/
        }
    }

    function enviarEmailReserva($nombre, $email, $idReserva) {
        if ($idReserva != null) {
            $data = $this->Reserva->find('first', array(
                'conditions' => array(
                    'Reserva.id' => $idReserva
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

            $fecha_hasta = ($this->data['Reserva']['fecha_hasta']);

            $fecha_desde = ($this->data['Reserva']['fecha_desde']);


            $Email = new CakeEmail('gmail');
            $Email->template('nueva_reserva', 'default');
            $Email->emailFormat('html');
            $Email->from(array('info@losrobles.com' => 'Los Robles'));
            $Email->to($email);
            $Email->subject('Nueva Reserva Realizada');
            $Email->viewVars(array(
                'nombre' => $nombre,
                'fecha_desde' => $fecha_desde,
                'fecha_hasta' => $fecha_hasta,
                'reserva' => $data
            ));
            $Email->send();
        }
    }

}
