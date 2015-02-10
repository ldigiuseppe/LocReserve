<?php

// app/Controller/UsuariosController.php
App::uses('AppController', 'Controller');

class UsuariosController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Usuario.id' => 'asc')
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login');
    }

    public function login() {

        //Si el usuario esta logueado, redirijo
        if ($this->Session->check('Auth.Usuario')) {
            $this->redirect(array('action' => 'index'));
        }

        // Si vien al informacion del POST intentamos loguear
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Bienvenido, ' . $this->Auth->user('nombre')), 'flash_success');
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash('Nombre de usuario o contraseña incorrecto!', 'flash_danger');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('Usuario.id' => 'asc')
        );
        $usuarios = $this->paginate('Usuario');
        $this->set(compact('usuarios'));
    }

    public function add() {
        if ($this->request->is('post')) {

            $this->Usuario->create();
            $this->Usuario->set('estado', '1');
            $this->Usuario->set('registro', date("Y-m-d H:i:s"));

            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('El nuevo usuario ha sido creado'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El usuario no pudo ser creado. Inténtelo nuevamente'), 'flash_danger');
            }
        }

        $this->set('roles', $this->Usuario->Rol->find(
                        'list', array(
                    'fields' => array('Rol.nombre'),
                    'order' => array('Rol.nombre')
        )));
    }

    public function edit($id = null) {

        if (!$id) {
            $this->Session->setFlash('Ha ingresado a una dirección iválida', 'flash_warning');
            $this->redirect(array('action' => 'index'));
        }

        $usuario = $this->Usuario->findById($id);

        if (!$usuario) {
            $this->Session->setFlash('Identificador de usuario inválido', 'flash_danger');
            $this->redirect(array('action' => 'index'));
        }

        $this->set('roles', $this->Usuario->Rol->find(
                        'list', array(
                    'fields' => array('Rol.nombre'),
                    'order' => array('Rol.nombre')
        )));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Usuario->id = $id;
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido actualizado'), 'flash_success');
                $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('No se ha podido actualizar el usuario.'), 'flash_danger');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $usuario;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->setFlash('Por favor indique un id de usuario', 'flash_warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            $this->Session->setFlash('Id de usuario inválido', 'flash_danger');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Usuario->saveField('status', 0)) {
            $this->Session->setFlash(__('El usuario ha sido eliminado'), 'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('No se ha podido eliminar el usuario'), 'flash_danger');
        $this->redirect(array('action' => 'index'));
    }

    public function activate($id = null) {

        if (!$id) {
            $this->Session->setFlash('Por favor indique un id de usuario', 'flash_warning');
            $this->redirect(array('action' => 'index'));
        }

        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            $this->Session->setFlash('Id de usuario inválido', 'flash_danger');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Usuario->saveField('status', 1)) {
            $this->Session->setFlash(__('Usuario re-activado'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuario no fue re-activado'));
        $this->redirect(array('action' => 'index'));
    }

}
